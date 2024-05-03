<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function profile()
    {
        $user = $this->getUser();

        if (!$user) {
            return new RedirectResponse($this->generateUrl('app_home'));
        }

        return $this->render('user/index.html.twig', [
            'user' => $user,
        ]);
    }
}