<?php

namespace App\Controller;

use App\Entity\Menus;
use App\Entity\Openings;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenusController extends AbstractController
{
    #[Route('/notre-carte', name: 'app_menus')]
    public function index(ManagerRegistry $doctrine): Response
    {
        // Retrieve all menu table data
        // Replaces getDoctrine() which is deprecated
        $menus = $doctrine -> getRepository(Menus::class) -> findAll();

        // Retrieve the opening hours from the database
        $openings = $doctrine -> getRepository(Openings::class) -> findAll();
        // Render the view of the opening hours table with "renderView" method
        $openingsView = $this -> renderView('_partials/_openings.html.twig', [
            'openings' => $openings
        ]);

        //  Tableau qui sert à grouper les menus par catégorie
        $groupedMenus = [];
        // Boucle qui itére sur les menus récupérés précédemment avec la méthode findAll()
        foreach ($menus as $menu) {
            // récupère le nom de la catégorie du menu
            $categoryName = $menu -> getCategories() -> getDishCategorie();
            // Ajoute le menu dans le tableau $groupedMenus
            $groupedMenus[$categoryName][] = $menu;
        }
        return $this->render('menus/index.html.twig', [
            'groupedMenus' => $groupedMenus,
            'openingsView' => $openingsView
        ]);
    }
}