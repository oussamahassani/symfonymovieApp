<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Movie;
use App\Entity\Comment;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle(' - BACKOFFICE');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linktoRoute('Back to the website', 'fas fa-undo', 'app_home'),
            MenuItem::linkToDashboard('Home', 'fa fa-fa-home'),
            // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
            // links to the 'index' action of the Category CRUD controller
            MenuItem::linkToCrud('Movies', 'fa fa-list', Movie::class),
            MenuItem::linkToCrud('Comments', 'fas fa-tags', Comment::class),
            MenuItem::linkToCrud('Users', 'fas fa-list', User::class),
        ];
    }
}
