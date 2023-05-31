<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{

  private $em;

  /** @param $em */

  public function __construct(EntityManagerInterface $em){
    $this->em = $em;
  }


    #[Route('/post', name: 'app_post')]
    public function index(Request $request): Response
    {

      $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");

      // /** @var User $user */
      // $user = $this->getUser();
  
      // return match ($user->isVerified()) {      




			// true => $this->render('post/index.html.twig', [
      //           'controller_name' => 'PostController',
      //           'controller_mydump' => ['saludoIni'=>'Hola', 'saludoFin'=>'Devs'],
      //       ]),
			// false => $this->render("post/please-verify-email.html.twig"),

      $post = new Post();
      $form = $this->createForm(PostType::class, $post);
      $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid()){
        $this->em->persist($post);
        $this->em->flush();
        return $this->redirectToRoute(route: 'app_post');
      }

      return $this->render("post/index.html.twig",[
        'form' => $form->createView()

      ]);

		// };        
    }
}
