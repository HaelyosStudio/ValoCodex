<?php

namespace App\DataFixtures;

use App\Entity\WeaponCategory;
use Doctrine\Persistence\ObjectManager;

class WeaponCategoryFixtures extends AbstractFixtures
{
    public function load(ObjectManager $manager)
    {
        $weaponCategories = ['Pistol', 'SMG', 'Shotgun', 'Rifle', 'Sniper', 'Heavy'];

        for ($i = 0; $i < 6; $i++) {
            $category = new WeaponCategory();
            $category->setTitle($weaponCategories[$i]);
            $manager->persist($category);

            $this->setReference('category_' . $i, $category);
        }

        $manager->flush();
    }
}
