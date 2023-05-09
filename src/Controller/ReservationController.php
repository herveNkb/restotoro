<?php

namespace App\Controller;

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

        $form = $this->createForm(ReservationFormType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $reservation = $form->getData();

            $doctrine->getManager()->persist($reservation);
            $doctrine->getManager()->flush();

            $this->addFlash('success', 'Votre réservation a bien été enregistrée');

            return $this->redirectToRoute('app_reservation');
        }


        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
            'form' => $form->createView(),
        ]);
    }
}
