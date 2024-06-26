<?php

namespace App\Controller\Admin;

use App\Entity\WeaponCategory;
use App\Entity\Weapon;
use App\Entity\Agent;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Valocodex');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Users', 'fa-solid fa-user', User::class);
        yield MenuItem::linkToCrud('Agents', 'fa-solid fa-user-ninja', Agent::class);
        yield MenuItem::linkToCrud('Weapons', 'fa-solid fa-gun', Weapon::class);
        yield MenuItem::linkToCrud('WeaponCategory', 'fa-solid fa-coins', WeaponCategory::class);
    }
}
