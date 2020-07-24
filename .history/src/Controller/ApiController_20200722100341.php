<?php

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class ApiController extends AbstractController
{

  /**
   * @Route("/api/post", name="api_post_index", methods={"GET"})
   */
  public function index(UserRepository $userRepository)
  {
    return $this->json($userRepository->findAll(), 200, [], ['groups' => 'post:read']);
  }

  /**
   * @Route("/api/post", name="api_post_store", methods={"POST"})
   */
  public function store(Request $request, SerializerInterface $serializer, EntityManagerInterface $em)
  {
    $jsonRecu = $request->getContent();

    try {
      $post = $serializer->deserialize($jsonRecu, Post::class, 'json');
      $post->setCreatedAt(new \DateTime());
      $em->persist($post);
      $em->flush();
      return $this->json($post, 201, [], ['groups' => 'post:read']);
    } catch (NotEncodableValueException $e) {
      return  $this->json([
        'status' => 400,
        'message' => $e->getMessage()
      ], 400);
    }
  }
}