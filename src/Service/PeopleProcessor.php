<?php
namespace App\Service;

use App\Entity\People;
use App\Form\Model\PeopleDto;
use App\Repository\PeopleRepository;
use App\Form\Type\PeopleFormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class PeopleProcessor
{

    public function __construct(
        private PeopleService $peopleService,
        private PeopleRepository $clubRepository,
        private FormFactoryInterface $formFactory,
        private ClubService $clubService,
        private ClubProcessor $clubProcessor
    ) {
    }

    public function createPeopleProcessor(People $people, Request $request, int $clubId = null){
        $peopleDto = PeopleDto::createEmpty();
        $form = $this->formFactory->create(PeopleFormType::class, $peopleDto);
        $form->handleRequest($request);
        if (!$form->isSubmitted()) {
            return [null, 'Form is not submitted'];
        }
        if (!$form->isValid()) {
            return [null, $form];
        }
        $people->setName($peopleDto->name);
        $people->setLastName($peopleDto->lastName);
        $people->setAge($peopleDto->age);
        $people->setClubId($clubId);
        $people->setSalary($peopleDto->salary);
        $people->setType($peopleDto->type);
        $this->peopleService->save($people);
        return [$people, null];
    }

    public function addClub(People $people, Request $request){
        $content = json_decode($request->getContent(), true);
        $club = $this->clubService->getById($content['clubId']);
        if(!$club){
            return [null, "Club not found"];
        }
        if(!$this->clubProcessor->checkBudgetInClubForNewSalary($club, $people)){
            return [null, "The actual budget of club cannot afford the salary of new member"];
        }
        if($people->getClubId()){
            return [null, "Cannot add member. This member belongs to club id " .$people->getClubId()];
        }
        [$people, $error] = $people->patch($content);
        if(!$people){
            return [null, $error];
        }
        $this->peopleService->save($people);
        return [$people, null];
    }

    public function removeClub(People $people){
        [$people, $error] = $people->patch();
        if(!$people){
            return [null, $error];
        }
        $this->peopleService->save($people);
        return [$people, null];
    }

}
