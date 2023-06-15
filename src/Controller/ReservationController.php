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
use App\Repository\ReservationsRepository;

class ReservationController extends AbstractController
{
    private $reservationsRepository;

    public function __construct(ReservationsRepository $reservationsRepository)
    {
        $this -> reservationsRepository = $reservationsRepository;
    }

    #[Route('/reservation', name: 'app_reservation')]
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {// Retrieves booking settings
        $settings = $doctrine -> getRepository(ReservationsSettings::class) -> findOneBy([]);

        // If no reservation parameter has been configured, throws an exception
        if (!$settings) {
            throw $this -> createNotFoundException('Aucun paramètre de réservation n\'a été configuré.');
        }

        $user = $this -> getUser(); // Get logged in user
        if ($user) {
            // Uses logged in user's data to pre-fill the form
            $reservation = new Reservations();
            $defaultCustomerNumber = $user -> getDefaultCustomerNumber();
            // Checks if the user has a default place setting
            if ($defaultCustomerNumber !== null) {
                $reservation -> setCustomerNumber($defaultCustomerNumber);
            }
            $reservation -> setAllergies($user -> getDefaultAllergies());

            // Create the form by passing it the reservation object
            $form = $this -> createForm(ReservationFormType::class, $reservation);
        } else {
            $form = $this -> createForm(ReservationFormType::class);
        }

        // Process form data
        $form -> handleRequest($request);

        if ($form -> isSubmitted() && $form -> isValid()) {
            $reservation = $form -> getData();

            // Checks if the number of guests for the booking date has reached the maximum allowed
            $dateReservation = $reservation -> getDateReservation();
            $numberOfCustomers = $this -> reservationsRepository -> countReservationsForDate($dateReservation);

            $maxCustomersPerDay = $settings -> getMaxCustomersPerDay();
            // Checks if the total number of guests for this reservation exceeds the maximum allowed
            $totalNumberOfCustomers = $this -> reservationsRepository -> countTotalCustomersForDate($dateReservation);
            if ($maxCustomersPerDay !== null && $totalNumberOfCustomers + $reservation -> getCustomerNumber() > $maxCustomersPerDay) {
                $this -> addFlash('error', 'Réservation impossible car le nombre maximum de clients pour cette date a été atteint.');
                return $this -> redirectToRoute('app_main');
            }

            //Retrieves booking time
            $reservation -> setHourReservation($reservation -> getHourReservation());

            $doctrine -> getManager() -> persist($reservation);
            $doctrine -> getManager() -> flush();

            $this -> addFlash('success', 'Votre réservation a bien été enregistrée');

            return $this -> redirectToRoute('app_main');
        }

        return $this -> render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
            'form' => $form -> createView(),
        ]);
    }
}