<?php

namespace App\Controller\Admin;

use App\Entity\Genus;
use App\Entity\Species;
use App\Entity\Taxon;
use App\Entity\Variety;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin', name: 'admin')] 
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Fossil Diatoms');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Taxa');
        yield MenuItem::linkToCrud('Genera', 'fa fa-tags', Genus::class);
        yield MenuItem::linkToCrud('Species', 'fa fa-file-text', Species::class);
        yield MenuItem::linkToCrud('Varieties', 'fa fa-file-text', Variety::class);
        yield MenuItem::linkToCrud('Taxa', 'fa fa-file-text', Taxon::class);
    }
}
