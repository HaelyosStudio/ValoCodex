<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Agent;
use Doctrine\ORM\EntityManagerInterface;

class AgentController extends AbstractController
{
    #[Route('/agents', name: 'app_agent')]
    public function agentHome(EntityManagerInterface $entityManager): Response
    {
        $agentRepository = $entityManager->getRepository(Agent::class);
        $agents = $agentRepository->findAll();

        return $this->render('agent/agentList.html.twig', [
            'controller_name' => 'AgentController',
            'agents' => $agents,
        ]);
    }

    #[Route('/agents/details/{id}', name: 'app_agent_details')]
    public function agentDetails($id, EntityManagerInterface $entityManager): Response
    {
        $agentRepository = $entityManager->getRepository(Agent::class);
        $agent = $agentRepository->find($id);

        return $this->render('agent/agentDetails.html.twig', [
            'controller_name' => 'AgentController',
            'agent' => $agent,
        ]);
    }
}
