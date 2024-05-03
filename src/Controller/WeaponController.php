<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Weapon;
use Doctrine\ORM\EntityManagerInterface;

class WeaponController extends AbstractController
{
    
    #[Route('/weapon', name: 'app_weapon')]
    public function weaponHome(EntityManagerInterface $entityManager): Response
    {
        $weaponRepository = $entityManager->getRepository(Weapon::class);
        $weapons = $weaponRepository->findAll();

        return $this->render('weapon/weaponHome.html.twig', [
            'controller_name' => 'WeaponController',
            'weapons' => $weapons,
        ]);
    }

    #[Route('/weapon/details/{id}', name: 'app_weapon_details')]
    public function weaponDetails($id, EntityManagerInterface $entityManager): Response
    {
        $weaponRepository = $entityManager->getRepository(Weapon::class);
        $weapon = $weaponRepository->find($id);

        return $this->render('weapon/weaponDetails.html.twig', [
            'controller_name' => 'WeaponController',
            'weapon' => $weapon,
        ]);
    }
}