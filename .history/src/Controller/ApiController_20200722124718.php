<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Profil;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class ApiController extends AbstractController
{
  public function api()
  {
    return new Response(sprintf('Logged in as %s', $this->getUser()->getUsername()));
  }

  /**
   * @Route("/register", name="registers")
   *
   * @param Request $request
   * @param UserPasswordEncoderInterface $encoder
   * @return void
   */
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
  /**
   * @Route("/api/post", name="api_post_index", methods={"GET"})
   */
  public function index(UserRepository $userRepository)
  {
    return $this->json($userRepository->findAll(), 200, [], ['groups' => 'post:read']);
  }

  /**
   * @Route("/api/profil", name="api_post_store", methods={"POST"})
   */
  public function store(Request $request, SerializerInterface $serializer, EntityManagerInterface $em)
  {
    $jsonRecu = $request->getContent();

    try {
      $post = $serializer->deserialize($jsonRecu, Profil::class, 'json');
      $em->persist($post);
      $em->flush();

      return $this->json($post, 201, []);
    } catch (NotEncodableValueException $e) {
      return  $this->json([
        'status' => 400,
        'message' => $e->getMessage()
      ], 400);
    }
  }

  /**
   * @Route("/api/deleteProfil/{id}", name="delete_profil", methods={"DELETE"})
   *
   * @param Request $request
   * @return void
   */
  public function delete(Profil $profil, Request $request, ManagerRegistry $manager)
  {
    if ($profil->getId()) {
      $managers = $manager->getManager();
      $managers->remove($profil);
      $managers->flush();
      if (!$profil->getId()) {
        return $this->json([
          'code' => 200,
          'message' => 'supprimer avec succé'
        ]);
      }
    }
  }

  /**
   * @Route("/api/updateProfil/{id}", name="update_profil", methods={"PUT"})
   */

  public function modifierProfil(Profil $profil, Request $request, ManagerRegistry $manager)
  {
  }
}