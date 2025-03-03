<?php

namespace App\Controller\Admin;

use App\Entity\Camera;
use App\Entity\Campaign;
use App\Entity\Genus;
use App\Entity\Geography;
use App\Entity\Microscope;
use App\Entity\Model;
use App\Entity\Objective;
use App\Entity\Photo;
use App\Entity\Producer;
use App\Entity\RelativeAge;
use App\Entity\Sample;
use App\Entity\Site;
use App\Entity\SiteType;
use App\Entity\Species;
use App\Entity\Taxon;
use App\Entity\TaxonType;
use App\Entity\Technique;
use App\Entity\Update;
use App\Entity\Variety;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
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
        yield MenuItem::linkToUrl('Homepage', 'fa fa-home', $this->generateUrl('app_atlas_homepage'));

        yield MenuItem::section('Sites');
        yield MenuItem::linkToCrud('Sample', 'fa fa-home', Sample::class);
        yield MenuItem::linkToCrud('Site type', 'fa fa-home', SiteType::class);
        yield MenuItem::linkToCrud('Campaign', 'fa fa-home', Campaign::class);
        yield MenuItem::linkToCrud('Geography', 'fa fa-home', Geography::class);
        yield MenuItem::linkToCrud('Site', 'fa fa-home', Site::class);

        yield MenuItem::section('Microscopes');
        yield MenuItem::linkToCrud('Producer', 'fa fa-tags', Producer::class);
        yield MenuItem::linkToCrud('Model', 'fa fa-tags', Model::class);
        yield MenuItem::linkToCrud('Objective', 'fa fa-tags', Objective::class);
        yield MenuItem::linkToCrud('Camera', 'fa fa-tags', Camera::class);
        yield MenuItem::linkToCrud('Technique', 'fa fa-tags', Technique::class);
        yield MenuItem::linkToCrud('Microscope', 'fa fa-tags', Microscope::class);

        yield MenuItem::section('Ages');
        yield MenuItem::linkToCrud('Relative ages', 'fa fa-tags', RelativeAge::class);

        yield MenuItem::section('Taxa');
        yield MenuItem::linkToCrud('Genus', 'fa fa-tags', Genus::class);
        yield MenuItem::linkToCrud('Species', 'fa fa-file-text', Species::class);
        yield MenuItem::linkToCrud('Variety', 'fa fa-file-text', Variety::class);
        yield MenuItem::linkToCrud('Taxon type', 'fa fa-file-text', TaxonType::class);
        yield MenuItem::linkToCrud('Taxon', 'fa fa-file-text', Taxon::class);

        yield MenuItem::section('Photos');
        yield MenuItem::linkToCrud('Photo', 'fa fa-file-text', Photo::class);

        yield MenuItem::section('Updates');
        yield MenuItem::linkToCrud('Update', 'fa fa-tags', Update::class);

        yield MenuItem::section('Users');
        yield MenuItem::linkToCrud('User', 'fa fa-file-text', User::class);
    }

    public function configureActions(): Actions
    {
        return parent::configureActions()
            ->add(Crud::PAGE_INDEX, Action::DETAIL);   
    }

//    public function configureAssets(): Assets
//    {
//        return parent::configureAssets()
//            ->addWebpackEncoreEntry('app');
//    }


}
