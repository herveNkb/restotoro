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

        //  Table used to group menus by category
        $groupedMenus = [];
        // Loop that iterates over the menus retrieved previously with the findAll() method
        foreach ($menus as $menu) {
            // get menu category name
            $categoryName = $menu -> getCategories() -> getDishCategorie();
            // Add the menu to the array $groupedMenus
            $groupedMenus[$categoryName][] = $menu;
        }
        return $this -> render('menus/index.html.twig', [
            'groupedMenus' => $groupedMenus,
            'openingsView' => $openingsView
        ]);
    }
}