<?php


namespace App\Controller;

use App\Entity\Openings;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OpeningsController extends AbstractController
{
    #[Route('/horaires', name: 'app_openings')]
    public function index(ManagerRegistry $doctrine): Response
    {
        // Retrieve data from database
        // Replaces getDoctrine() which is deprecated since Symfony 5.3
        $openings = $doctrine -> getRepository(Openings::class) -> findAll();

        return $this->render('_partials/_openings.html.twig', [
            'openings' => $openings
        ]);
    }
}