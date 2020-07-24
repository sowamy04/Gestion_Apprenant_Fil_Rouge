<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApprenantController extends AbstractController
{

  /**
   * @Route("/apprenant", name="apprenant_liste")
   *  @Route(
   * name="apprenant_liste",
   * path="api/apprenants",
   * methods={"GET"},
   * defaults={
   * "_controller"="\app\ControllerApprenantController::showApprenant",
   * "_api_resource_class"=User::class,
   * "_api_collection_operation_name"="get_apprenants"
   * }
   * )
   */
  public function showApprenant(UserRepository $repo)
  {
    $apprenants = $repo->findByProfil("APPRENANT");
    return $this->json($apprenants, Response::HTTP_OK);
  }

  /**
   *
   *  @Route(
   * name="apprenant_id",
   * path="api/apprenants/{id}",
   * methods={"GET"},
   * defaults={
   * "_controller"="\app\ControllerApprenantController::showApprenantid",
   * "_api_resource_class"=User::class,
   * "_api_collection_operation_name"="get_apprenants_id"
   * }
   * )
   */
  public function showApprenantid(SerializerInterface $serializer, UserRepository $repo, Request $request)
  {
    //dd($request);
    $id = $request->get("id");
    $t = (int)$id;
    // $r=$serializer->serialize($id,"json");
    //dd($t);
    $apprenants = $repo->findByid($t);
    //dd($apprenants);
    return $this->json($apprenants, Response::HTTP_OK);
  }

  /**
   *
   *  @Route(
   * name="apprenant_update",
   * path="api/apprenants/{id}",
   * methods={"GET"},
   * defaults={
   * "_controller"="\app\ControllerApprenantController::apprenantId",
   * "_api_resource_class"=User::class,
   * "_api_collection_operation_name"="get_apprenants_id"
   * }
   * )
   */
  public function apprenantId(SerializerInterface $serializer, UserRepository $repo, Request $request)
  {
    //dd($request);
    $id = $request->get("id");
    $t = (int)$id;
    // $r=$serializer->serialize($id,"json");
    //dd($t);
    $apprenants = $repo->findByid($t);
    //dd($apprenants);
    return $this->json($apprenants, Response::HTTP_OK);
  }

  /**
   *
   *  @Route(
   * name="apprenant_recup",
   * path="api/apprenants/{id}",
   * methods={"GET"},
   * defaults={
   * "_controller"="\app\ControllerApprenantController::apprenantModif",
   * "_api_resource_class"=User::class,
   * "_api_collection_operation_name"="get_apprenants_id"
   * }
   * )
   */
  public function apprenantModif()
  {
  }

  /**
   *
   *  @Route(
   * name="apprenant_delete",
   * path="api/apprenants/{id}",
   * methods={"DELETE"},
   * defaults={
   * "_controller"="\app\ControllerApprenantController::deleteApprenant",
   * "_api_resource_class"=User::class,
   * "_api_collection_operation_name"="get_apprenants_id"
   * }
   * )
   */
  public function deleteApprenant(User $user, Request $request, ManagerRegistry $manager)
  {
    if ($user->getId()) {
      $managers = $manager->getManager();
      $managers->remove($user);
      $managers->flush();
      if (!$user->getId()) {
        return $this->json([
          'code' => 200,
          'message' => 'supprimer avec succé'
        ]);
      }
    }
  }
}