<?php

namespace App\DataFixtures;

use App\Entity\Weapon;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class WeaponFixtures extends AbstractFixtures implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {


        $weapons = [
            [
                'name' => 'Classic',
                'mag_capacity' => 12,
                'wall_penetration' => 'Low',
                'price' => 1000,
                'primary_fire' => 9.9,
                'secondary_fire' => 5.6,
                'category' => 0,
            ],
            [
                'name' => 'Shorty',
                'mag_capacity' => 2,
                'wall_penetration' => 'Low',
                'price' => 1500,
                'primary_fire' => 1.75,
                'secondary_fire' => 0,
                'category' => 0,
            ],
            [
                'name' => 'Frenzy',
                'mag_capacity' => 13,
                'wall_penetration' => 'Low',
                'price' => 4500,
                'primary_fire' => 12.75,
                'secondary_fire' => 0,
                'category' => 0,
            ],
            [
                'name' => 'Ghost',
                'mag_capacity' => 15,
                'wall_penetration' => 'Medium',
                'price' => 5000,
                'primary_fire' => 10.5,
                'secondary_fire' => 0,
                'category' => 0,
            ],
            [
                'name' => 'Sheriff',
                'mag_capacity' => 6,
                'wall_penetration' => 'High',
                'price' => 800,
                'primary_fire' => 4.76,
                'secondary_fire' => 0,
                'category' => 0,
            ],
            [
                'name' => 'Stinger',
                'mag_capacity' => 20,
                'wall_penetration' => 'Low',
                'price' => 1100,
                'primary_fire' => 18,
                'secondary_fire' => 0,
                'category' => 1,
            ],
            [
                'name' => 'Spectre',
                'mag_capacity' => 30,
                'wall_penetration' => 'Medium',
                'price' => 1600,
                'primary_fire' => 13.33,
                'secondary_fire' => 0,
                'category' => 1,
            ],
            [
                'name' => 'Bucky',
                'mag_capacity' => 5,
                'wall_penetration' => 'Medium',
                'price' => 900,
                'primary_fire' => 4.8,
                'secondary_fire' => 3.1,
                'category' => 2,
            ],
            [
                'name' => 'Judge',
                'mag_capacity' => 7,
                'wall_penetration' => 'Medium',
                'price' => 1500,
                'primary_fire' => 3.33,
                'secondary_fire' => 0,
                'category' => 2,
            ],
            [
                'name' => 'Bulldog',
                'mag_capacity' => 24,
                'wall_penetration' => 'High',
                'price' => 2100,
                'primary_fire' => 9.15,
                'secondary_fire' => 0,
                'category' => 3,
            ],
            [
                'name' => 'Guardian',
                'mag_capacity' => 12,
                'wall_penetration' => 'High',
                'price' => 2700,
                'primary_fire' => 6.67,
                'secondary_fire' => 0,
                'category' => 3,
            ],
            [
                'name' => 'Phantom',
                'mag_capacity' => 30,
                'wall_penetration' => 'High',
                'price' => 2900,
                'primary_fire' => 11.11,
                'secondary_fire' => 0,
                'category' => 3,
            ],
            [
                'name' => 'Vandal',
                'mag_capacity' => 25,
                'wall_penetration' => 'High',
                'price' => 2900,
                'primary_fire' => 9.09,
                'secondary_fire' => 0,
                'category' => 3,
            ],
            [
                'name' => 'Marshal',
                'mag_capacity' => 5,
                'wall_penetration' => 'High',
                'price' => 1100,
                'primary_fire' => 4.55,
                'secondary_fire' => 0,
                'category' => 4,
            ],
            [
                'name' => 'Outlaw',
                'mag_capacity' => 2,
                'wall_penetration' => 'High',
                'price' => 2400,
                'primary_fire' => 2.75,
                'secondary_fire' => 0,
                'category' => 4,
            ],
            [
                'name' => 'Operator',
                'mag_capacity' => 5,
                'wall_penetration' => 'High',
                'price' => 4700,
                'primary_fire' => 0.75,
                'secondary_fire' => 0,
                'category' => 4,
            ],
            [
                'name' => 'Ares',
                'mag_capacity' => 50,
                'wall_penetration' => 'High',
                'price' => 1600,
                'primary_fire' => 13,
                'secondary_fire' => 0,
                'category' => 5,
            ],
            [
                'name' => 'Odin',
                'mag_capacity' => 100,
                'wall_penetration' => 'High',
                'price' => 3200,
                'primary_fire' => 12,
                'secondary_fire' => 0,
                'category' => 5,
            ],
        ];

        for ($i = 0; $i < 18; $i++) {
            $weapon = new Weapon();
            $weapon->setName($weapons[$i]['name']);
            $weapon->setWeaponCategory($this->getReference('category_' . $weapons[$i]['category']));
            $weapon->setMagCapacity($weapons[$i]['mag_capacity']);
            $weapon->setWallPenetration($weapons[$i]['wall_penetration']);
            $weapon->setPrice($weapons[$i]['price']);
            $weapon->setPrimaryFire($weapons[$i]['primary_fire']);
            $weapon->setSecondaryFire($weapons[$i]['secondary_fire']);
            $weapon->setImageName(strtolower($weapons[$i]['name']) . '.png');

            $this->setReference('weapon_' . $i, $weapon);

            $manager->persist($weapon);
        }

        $manager->flush();
    }

    function getDependencies()
    {
        return [
            WeaponCategoryFixtures::class,
        ];
    }
}
