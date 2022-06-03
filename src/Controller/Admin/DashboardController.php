<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Trick;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('account');
        }
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Snowtricks - Tableau de bord');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Global')->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToRoute('Voir le site','fa fa-arrow-right', 'home')->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home')->setPermission('ROLE_ADMIN');

        yield MenuItem::section('Utilisateurs')->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Commentaires', 'fas fa-comment', Comment::class)->setPermission('ROLE_ADMIN');

        yield MenuItem::section('Tricks')->setPermission('ROLE_USER');
        yield MenuItem::linkToCrud('Tricks', 'fas fa-snowboarding', Trick::class)->setPermission('ROLE_USER');
        yield MenuItem::linkToCrud('Categories', 'fas fa-list', Category::class)->setPermission('ROLE_ADMIN');
    }
}
