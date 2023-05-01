<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use App\Entity\Images;
use App\Entity\Menus;
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
         yield MenuItem::linkToCrud('Carte des plats', 'fas fa-utensils', Menus::class);
         yield MenuItem::linkToCrud('Catégories des plats', 'fas fa-list', Categories::class);
        yield MenuItem ::linkToUrl('Retour à l\'accueil', 'fas fa-home', $this -> generateUrl('app_main'));
    }
}
