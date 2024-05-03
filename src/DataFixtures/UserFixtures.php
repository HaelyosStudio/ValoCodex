<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UserFixtures extends AbstractFixtures implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {

        $roles = ['ROLE_USER', 'ROLE_ADMIN'];

        $admin = new User();
        $adminRole = $roles[1];
        $admin->setRoles([$adminRole]);
        $admin->setUsername('Hanyun');
        $admin->setEmail('hanyun@valocodex.com');
        $plainAdminPassword = 'adminPass';
        $hashedAdminPassword = password_hash($plainAdminPassword, PASSWORD_DEFAULT);
        $admin->setPassword($hashedAdminPassword);
        $admin->setWallet(9999);
        $admin->setAgent($this->getReference(('agent_2')));

        $manager->persist($admin);

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $role = $roles[$this->faker->numberBetween(0, 1)];
            $user->setRoles([$role]);
            $user->setUsername($this->faker->userName());
            $user->setEmail($this->faker->email());
            $plainPassword = $this->faker->password;
            $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);
            $user->setPassword($hashedPassword);
            $walletNumber = null;
            do {
                $walletNumber = $this->faker->randomNumber(4);
            } while ($walletNumber % 10 !== 0 || $walletNumber < 10 || $walletNumber > 2500);
            $user->setWallet($walletNumber);
            $user->setAgent($this->getReference('agent_' . $this->faker->numberBetween(0, 23)));

            $this->setReference('user_' . $i, $user);

            $manager->persist($user);
        }

        $manager->flush();
    }

    function getDependencies()
    {
        return [
            AgentFixtures::class,
        ];
    }
}
