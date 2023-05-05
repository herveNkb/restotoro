<?php


namespace App\Controller\UsersAdmin;

use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersDashboardController extends AbstractDashboardController
{

    #[Route('/profil', name: 'profil')]
    public function index(): Response
    {
        return $this -> render('usersAdmin/usersDashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard ::new()
            -> setTitle('User Dashboard');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem ::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem ::section('Mon profil');
        yield MenuItem ::linkToCrud('Profil', 'fa fa-user', Users::class) -> setAction('detail');
    }
}
