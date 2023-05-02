<?php

namespace App\Controller;

use App\Entity\Formulas;
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
        return $this->render('formulas/index.html.twig', [
            'formulas' => $formulas
        ]);
    }
}
