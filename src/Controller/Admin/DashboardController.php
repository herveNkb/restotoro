<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use App\Entity\Formulas;
use App\Entity\Images;
use App\Entity\Menus;
use App\Entity\Openings;
use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Le Quai Antique');
    }

// Right menu
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-utensils');
         yield MenuItem::linkToCrud('Images page d\'accueil', 'fas fa-image', Images::class);
        yield MenuItem::subMenu('gestion de la carte', 'fa fa-utensils')->setSubItems([
          MenuItem::linkToCrud('Carte des plats', 'fas fa-utensils', Menus::class),
          MenuItem::linkToCrud('Catégories des plats', 'fas fa-list', Categories::class)
        ]);
         yield MenuItem::linkToCrud('Formules de la carte', 'fas fa-clipboard', Formulas::class);
         yield MenuItem::linkToCrud('Horaires d\'ouverture', 'fas fa-clock', Openings::class);
         yield MenuItem::linkToCrud('Profils', 'fas fa-user', Users::class);
        yield MenuItem ::linkToUrl('Retour à l\'accueil', 'fas fa-home', $this -> generateUrl('app_main'));
    }

    // Add "consulter" button on admin index page
    public function configureActions(): Actions
    {
        return parent ::configureActions()
            -> add(Crud::PAGE_INDEX, Action::DETAIL);
    }
}
