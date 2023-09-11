<?php

namespace App\Controller\Api;

use App\Form\Model\PeopleDto;
use App\Repository\PeopleRepository;
use App\Service\ClubService;
use App\Service\PeopleProcessor;
use App\Service\PeopleService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\View\View;


class PeopleController extends AbstractFOSRestController
{
    /**
     * @Rest\Get(path="/people/{id}")
     * @Rest\View(serializerGroups={"people"}, serializerEnableMaxDepthChecks=true)
     */

     public function getActionById (int $id, PeopleService $peopleService ) {
        return $peopleService->getById($id);
    }

    /**
     * @Rest\Get(path="/people")
     * @Rest\View(serializerGroups={"people"}, serializerEnableMaxDepthChecks=true)
     */

    public function getAction (PeopleService $peopleService ) {
        return $peopleService->getAll();
    }

    /**
     * @Rest\Get(path="club/{id}/players/")
     * @Rest\View(serializerGroups={"people"}, serializerEnableMaxDepthChecks=true)
     */

     public function getPlayersAction (int $id, ClubService $clubService, PeopleRepository $peopleRepository, Request $request ) {
        $club = $clubService->getById($id);
        if(!$club){
            return View::create("Club not found",  Response::HTTP_BAD_REQUEST); 
        }
        $defaultLimit = 20;
        $property = $request->query->get('property');
        $value = $request->query->get('value');
        $limit = $request->query->get('limit') ?? $defaultLimit;

        if(!property_exists(PeopleDto::class, $property, )){
            return View::create("Property not found",  Response::HTTP_BAD_REQUEST); 
        }

        if(!$property || !$value){
            $data = $peopleRepository->listPlayers($id, $limit);
        } else {
            $data = $peopleRepository->listPlayersByProp($id, $property, $value, $limit);
        }
        $statusCode = $data ? Response::HTTP_OK : Response::HTTP_NO_CONTENT;
        return View::create($data, $statusCode);        
    }

    /**
     * @Rest\Post(path="/people/create")
     * @Rest\View(serializerGroups={"people"}, serializerEnableMaxDepthChecks=true)
     */

     public function postAction (PeopleService $peopleService, PeopleProcessor $peopleProcessor, Request $request) {
        $people = $peopleService->create();
        [$people, $error] = $peopleProcessor->createPeopleProcessor($people, $request);
        $statusCode = $people ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST;
        $data = $people ?? $error;
        return View::create($data, $statusCode);
    }

    /**
     * @Rest\Patch(path="/people/{id}/addclub")
     * @Rest\View(serializerGroups={"people"}, serializerEnableMaxDepthChecks=true)
     */

     public function addClubAction (int $id, PeopleService $peopleService, PeopleProcessor $peopleProcessor, Request $request) {
        $people = $peopleService->getById($id);
        if(!$people){
            return View::create("Member not found", Response::HTTP_BAD_REQUEST);
        }
        [$people, $error] = $peopleProcessor->addClub($people, $request);
        $statusCode = $people ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST;
        $data = $people ?? $error;
        return View::create($data, $statusCode);
    }

            /**
     * @Rest\Patch(path="/people/{id}/removeclub")
     * @Rest\View(serializerGroups={"people"}, serializerEnableMaxDepthChecks=true)
     */

     public function removeClubAction (int $id, PeopleService $peopleService, PeopleProcessor $peopleProcessor, Request $request) {
        $people = $peopleService->getById($id);
        if(!$people){
            return View::create("Member not found", Response::HTTP_BAD_REQUEST);
        }
        [$people, $error] = $peopleProcessor->removeClub($people, $request);
        $statusCode = $people ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST;
        $data = $people ?? $error;
        return View::create($data, $statusCode);
    }

}