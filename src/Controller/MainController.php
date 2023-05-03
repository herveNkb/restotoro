<?php

namespace App\Controller;

use App\Entity\Images;
use App\Entity\Openings;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(ManagerRegistry $doctrine): Response
    {
        // Retrieve data from database
        // Replaces getDoctrine() which is deprecated since Symfony 5.3
        $images = $doctrine -> getRepository(Images::class) -> findAll();

        // Retrieve the opening hours from the database
        $openings = $doctrine -> getRepository(Openings::class) -> findAll();
        // Render the view of the opening hours table with "renderView" method
        $openingsView = $this -> renderView('_partials/_openings.html.twig', [
            'openings' => $openings
        ]);

        return $this -> render('main/index.html.twig', [
            'images' => $images,
            'openingsView' => $openingsView
        ]);
    }
}
