<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ProfilRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AuthController extends AbstractController
{

  public function register(Request $request, UserPasswordEncoderInterface $encoder)
  {
    $em = $this->getDoctrine()->getManager();

    $username = json_decode($request->getContent())->username;
    $password = json_decode($request->getContent())->password;

    $user = new User();
    $user->setEmail($username);
    $user->setRoles(['ROLE_USER']);
    $user->setPassword($encoder->encodePassword($user, $password));
    $em->persist($user);
    $em->flush();

    return new JsonResponse(sprintf('User %s successfully created', $user->getUsername()));
  }


  public function api()
  {
    return new Response(sprintf('Logged in as %s', $this->getUser()->getUsername()));
  }

  /**
   * @Route("/api/users", name="api_post_index", methods={"GET"})
   */
  public function index(ProfilRepository $postRepository)
  {
    return $this->json($postRepository->findAll(), 200, [], ['groups' => 'post:read']);
  }
}