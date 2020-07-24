<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
    * @Route("/admin", name="admin")
    *  @Route(
    * name="admin_liste",
    * path="api/admins",
    * methods={"GET"},
    * defaults={
    * "_controller"="\app\ControllerAdminController::showAdmin",
    * "_api_resource_class"=User::class,
    * "_api_collection_operation_name"="get_admin"
    * }
    * )
    */
    public function showAdmin(UserRepository $repo)
    {
        $admin= $repo->findByProfil("ADMIN");
        return $this->json($formateur,Response::HTTP_OK);
    }
    /**
    * @Route("/admin", name="admin_id")
    *  @Route(
    * name="admin_liste",
    * path="api/admins",
    * methods={"GET"},
    * defaults={
    * "_controller"="\app\ControllerAdminController::showAdmin",
    * "_api_resource_class"=User::class,
    * "_api_collection_operation_name"="get_admin"
    * }
    * )
    */
    public function adminId(UserRepository $repo)
    {
        $admin= $repo->findByProfil("ADMIN");
        return $this->json($formateur,Response::HTTP_OK);
    }
}
