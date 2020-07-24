<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormateurController extends AbstractController
{

    /**
     * @IsGranted("ROLE_ADMIN" or "ROLE_CM")
     * @Route("api/formateurs", name="formatursall", methods="{"GET}")
     *
     * @param UserRepository $repo
     * @return void
     */
    public function showFormateur(UserRepository $repo)
    {
        $formateur = $repo->findByProfil("FORMATEUR");

        return $this->json($formateur, Response::HTTP_OK);
    }


    /**
     * @Route("/apprenant", name="formateur_id")
     *  @Route(
     * name="formateur_listeId",
     * path="api/formateurListe",
     * methods={"GET"},
     * defaults={
     * "_controller"="\app\ControllerApprenantController::showFormateur",
     * "_api_resource_class"=User::class,
     * "_api_collection_operation_name"="get_formateurs"
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