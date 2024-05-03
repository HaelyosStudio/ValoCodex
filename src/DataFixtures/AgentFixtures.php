<?php

namespace App\DataFixtures;

use App\Entity\Agent;
use Doctrine\Persistence\ObjectManager;

class AgentFixtures extends AbstractFixtures
{
    public function load(ObjectManager $manager)
    {
        $agents = ['Phoenix', 'Sage', 'Jett', 'Viper', 'Cypher', 'Reyna', 'Brimstone', 'Omen', 'Killjoy', 'Skye', 'Yoru', 'Astra', 'Breach', 'Raze', 'Sova', 'KAYO', 'Chamber', 'Neon', 'Fade', 'Harbor', 'Gekko', 'Deadlock', 'Iso', 'Clove'];

        for ($i = 0; $i < count($agents); $i++) {
            $agent = new Agent();
            $agent->setName($agents[$i]);
            $agent->setImageName(strtolower($agents[$i]) . '.png');
            $manager->persist($agent);

            $this->setReference('agent_' . $i, $agent);
        }

        $manager->flush();
    }
}
