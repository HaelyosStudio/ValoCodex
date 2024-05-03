<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Weapon;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UserWeaponFixtures extends AbstractFixtures implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $user = $this->getReference('user_' . $i);
            $weapon = $this->getReference('weapon_' . $this->faker->numberBetween(0, 16));

            $user->addUserWeapon($weapon);

            $manager->persist($user);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            WeaponFixtures::class,
        ];
    }
}
