<?php

namespace App\Controller\Admin;

use App\Entity\Recipes;
use App\Entity\User;
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
        // return parent::index();
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            //->renderContentMaximized()
            //->renderSidebarMinimized() //sidebar with icons only
            //->disableDarkMode(true); //remove darkmode
            ->setTitle('Cookbook');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::linkToRoute('Back to website', 'fa-solid fa-arrow-rotate-left', 'app_home'),
            MenuItem::section('Users'),
            MenuItem::linkToCrud('Manage Users', 'fa-solid fa-user', User::class),
            MenuItem::section('Recipes'),
            MenuItem::linkToCrud('Manage Recipes', 'fa-solid fa-utensils', Recipes::class),    
        ];
    }
}
