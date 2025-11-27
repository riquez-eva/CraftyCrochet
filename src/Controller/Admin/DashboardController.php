<?php

namespace App\Controller\Admin;

use App\Entity\Detail;
use App\Entity\Article;
use App\Entity\Contact;
use App\Entity\Commande;
use App\Entity\Categorie;
use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('CraftyCrochet - Admin')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Articles', 'fas fa-list', Article::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-list', Categorie::class);
        yield MenuItem::linkToCrud('Contact', 'fas fa-list', Contact::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-list', Utilisateur::class);
        yield MenuItem::linkToCrud('Commandes', 'fas fa-list', Commande::class);
        yield MenuItem::linkToCrud('Details', 'fas fa-list', Detail::class);
    }
}
