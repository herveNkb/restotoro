<?php

namespace App\Controller;

use App\Entity\Formulas;
use App\Entity\Openings;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormulasController extends AbstractController
{
    #[Route('/nos-menus', name: 'app_formulas')]
    public function index(ManagerRegistry $doctrine): Response
    {
        // Retrieve data from database
        // Replaces getDoctrine() which is deprecated since Symfony 5.3
        $formulas = $doctrine -> getRepository(Formulas::class) -> findAll();

        // Retrieve the opening hours from the database
        $openings = $doctrine -> getRepository(Openings::class) -> findAll();
        // Render the view of the opening hours table with "renderView" method
        $openingsView = $this -> renderView('_partials/_openings.html.twig', [
            'openings' => $openings
        ]);

        return $this -> render('formulas/index.html.twig', [
            'formulas' => $formulas,
            'openingsView' => $openingsView
        ]);
    }
}
