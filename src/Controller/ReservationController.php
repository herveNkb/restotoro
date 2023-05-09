<?php

namespace App\Controller;

use App\Entity\Reservations;
use App\Entity\ReservationsSettings;
use App\Form\ReservationFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        // Récupérer les paramètres de réservation
        $settings = $doctrine->getRepository(ReservationsSettings::class)->findOneBy([]);

        // Si aucun paramètre de réservation n'a été configuré, lève une exception
        if (!$settings) {
            throw $this->createNotFoundException('Aucun paramètre de réservation n\'a été configuré.');
        }

        $user = $this->getUser(); // Récupérer l'utilisateur connecté
        if ($user) {
            // Utiliser les données de l'utilisateur connecté pour pré-remplir le formulaire
            $reservation = new Reservations();
            $reservation->setCustomerNumber($user->getDefaultCustomerNumber());
            $reservation->setAllergies($user->getDefaultAllergies());

            // Créer le formulaire en lui passant l'objet $reservation
            $form = $this->createForm(ReservationFormType::class, $reservation);
        } else {
            $form = $this->createForm(ReservationFormType::class);
        }

        // Traiter les données du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservation = $form->getData();

            // Récupérer l'heure de réservation
            $reservation->setHourReservation($reservation->getHourReservation());

            $doctrine->getManager()->persist($reservation);
            $doctrine->getManager()->flush();

            $this->addFlash('success', 'Votre réservation a bien été enregistrée');

            return $this->redirectToRoute('app_main');
        }

        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
            'form' => $form->createView(),
            // Ces paramètres sont utilisés dans le template Twig pour afficher les créneaux horaires
            'lunchTimeSlots' => $this->generateTimeSlots($settings->getLunchOpeningTime(), $settings->getLunchClosingTime()),
            'dinnerTimeSlots' => $this->generateTimeSlots($settings->getDinnerOpeningTime(), $settings->getDinnerClosingTime()),
        ]);
    }

    // génère les créneaux horaires
    private function generateTimeSlots(\DateTimeInterface $openingTime, \DateTimeInterface $closingTime): array
    {
        $interval = new \DateInterval('PT15M'); // Tranche de 15 minutes
        $period = new \DatePeriod($openingTime, $interval, $closingTime);
        $timeSlots = [];

        foreach ($period as $dt) {
            // la méthode format() permet de formater une date en chaîne de caractères
            $time = $dt->format('H:i');
            //  Utilisation de la même clé et valeur pour le tableau $timeSlots
            //  pour pouvoir afficher les créneaux horaires le template Twig
            $timeSlots[$time] = $time;
        }

        return $timeSlots;
    }
}