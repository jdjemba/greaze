<?php

namespace App\Controller\Admin;

use App\Entity\Album;
use App\Entity\Artist;
use App\Entity\Comment;
use App\Entity\Playlist;
use App\Entity\Track;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        return $this->redirect($adminUrlGenerator->setController(AlbumCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Greaze');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Music', 'fa fa-music');
        yield MenuItem::linkToCrud('Albums', '', Album::class);
        yield MenuItem::linkToCrud('Artists', '', Artist::class);
        yield MenuItem::linkToCrud('Playlists', '', Playlist::class);
        yield MenuItem::linkToCrud('Tracks', '', Track::class);

        yield MenuItem::section('Users', 'fa fa-users');
        yield MenuItem::linkToCrud('Comments', '', Comment::class);
        yield MenuItem::linkToCrud('Users', '', User::class);
    }
}
