<?php

namespace App\Controller\Api;

use App\Entity\Club;
use App\Repository\ClubRepository;
use App\Service\ClubService;
use App\Service\ClubProcessor;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\View\View;

class ClubController extends AbstractFOSRestController
{
    /**
     * @Rest\Get(path="/clubs")
     * @Rest\View(serializerGroups={"club"}, serializerEnableMaxDepthChecks=true)
     */

    public function getAllAction (ClubService $clubService, ClubRepository $repository ) {
        return $clubService->getAll();
    }


        /**
     * @Rest\Get(path="/club/{id}")
     * @Rest\View(serializerGroups={"club"}, serializerEnableMaxDepthChecks=true)
     */

     public function getByIdAction (int $id, ClubService $clubService) {
        return $clubService->getById($id);
    }
    

    /**
     * @Rest\Post(path="/club/create")
     * @Rest\View(serializerGroups={"club"}, serializerEnableMaxDepthChecks=true)
     */

     public function postAction (ClubService $clubService, ClubProcessor $clubProcessor, Request $request) {
        $club = $clubService->create();
        [$club, $error] = $clubProcessor->createClubProcessor($club, $request);
        $statusCode = $club ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST;
        $data = $club ?? $error;
        return View::create($data, $statusCode);
    }

    /**
     * @Rest\Patch(path="/club/{id}/edit-budget")
     * @Rest\View(serializerGroups={"club"}, serializerEnableMaxDepthChecks=true)
     */

     public function updateBudgetAction (int $id, ClubService $clubService, ClubProcessor $clubProcessor, Request $request) {
        $club = $clubService->getById($id);
        if(!$club){
            return View::create("Club not found", Response::HTTP_BAD_REQUEST);
        }
        [$club, $error] = $clubProcessor->updateBudgetProcessor($club, $request);
        $statusCode = $club ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST;
        $data = $club ?? $error;
        return View::create($data, $statusCode);
    }

}