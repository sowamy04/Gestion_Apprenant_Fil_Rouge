<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormateurController extends AbstractController
{
    /**
     *  @Route(
     * name="formateur_liste",
     * path="api/formateurs",
     * methods={"GET"},
     * defaults={
     * "_controller"="\app\ControllerApprenantController::showFormateur",
     * "_api_resource_class"=User::class,
     * "_api_collection_operation_name"="get_formateur"
     * }
     * )
     */
    public function showFormateur(UserRepository $repo)
    {
        $formateur = $repo->findByProfil("FORMATEUR");
        dd($formateur);
        return $this->json($formateur, Response::HTTP_OK);
    }


    /**
     * @Route("/apprenant", name="formateur_id")
     *  @Route(
     * name="formateur_liste",
     * path="api/formateurs",
     * methods={"GET"},
     * defaults={
     * "_controller"="\app\ControllerApprenantController::showFormateur",
     * "_api_resource_class"=User::class,
     * "_api_collection_operation_name"="get_formateur"
     * }
     * )
     */
    public function formateurId(UserRepository $repo)
    {
    }

    /**
     * @Route("/apprenant", name="user_liste")
     *  @Route(
     * name="formateur_liste",
     * path="api/formateurs",
     * methods={"GET"},
     * defaults={
     * "_controller"="\app\ControllerApprenantController::showFormateur",
     * "_api_resource_class"=User::class,
     * "_api_collection_operation_name"="get_formateur"
     * }
     * )
     */
    public function userid(UserRepository $repo)
    {
    }
}