<?php

namespace App\Controller;

use App\Entity\Menus;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenusController extends AbstractController
{
    #[Route('/notre-carte', name: 'app_menus')]
    public function index(ManagerRegistry $doctrine): Response
    {
        // Retrieve data from database
        // Replaces getDoctrine() which is deprecated
        $menus = $doctrine -> getRepository(Menus::class) -> findAll();
        return $this->render('menus/index.html.twig', [
            'menus' => $menus
        ]);
    }
}