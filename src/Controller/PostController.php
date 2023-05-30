<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/post', name: 'app_post')]
    public function index(): Response
    {

		$this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");

		/** @var User $user */
		$user = $this->getUser();

		return match ($user->isVerified()) {
			true => $this->render('post/index.html.twig', [
                'controller_name' => 'PostController',
                'controller_mydump' => ['saludoIni'=>'Hola', 'saludoFin'=>'Devs'],
            ]),
			false => $this->render("post/please-verify-email.html.twig"),
		};        
    }
}
