<?php

namespace App\Controller;

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
        $settings = $doctrine->getRepository(ReservationsSettings::class)->findOneBy([]);

        if (!$settings) {
            throw $this->createNotFoundException('Aucun paramètre de réservation n\'a été configuré.');
        }

        $form = $this->createForm(ReservationFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservation = $form->getData();

            $reservation->setHourReservation($reservation->getHourReservation());

            $doctrine->getManager()->persist($reservation);
            $doctrine->getManager()->flush();

            $this->addFlash('success', 'Votre réservation a bien été enregistrée');

            return $this->redirectToRoute('app_main');
        }

        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
            'form' => $form->createView(),
            'lunchTimeSlots' => $this->generateTimeSlots($settings->getLunchOpeningTime(), $settings->getLunchClosingTime()),
            'dinnerTimeSlots' => $this->generateTimeSlots($settings->getDinnerOpeningTime(), $settings->getDinnerClosingTime()),
        ]);
    }

    private function generateTimeSlots(\DateTimeInterface $openingTime, \DateTimeInterface $closingTime): array
    {
        $interval = new \DateInterval('PT15M'); // Tranche de 15 minutes
        $period = new \DatePeriod($openingTime, $interval, $closingTime);

        $timeSlots = [];

        foreach ($period as $dt) {
            $time = $dt->format('H:i');
            $timeSlots[$time] = $time;
        }

        return $timeSlots;
    }
}