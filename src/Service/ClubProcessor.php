<?php
namespace App\Service;

use App\Entity\Club;
use App\Entity\People;
use App\Form\Model\ClubDto;
use App\Repository\ClubRepository;
use App\Form\Type\ClubFormType;
use App\Repository\PeopleRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class ClubProcessor
{

    public function __construct(
        private ClubService $clubService,
        private ClubRepository $clubRepository,
        private FormFactoryInterface $formFactory,
        private PeopleRepository $peopleRepository
    ) {
    }

    public function createClubProcessor(Club $club, Request $request){
        $clubDto = ClubDto::createEmpty();
        $form = $this->formFactory->create(ClubFormType::class, $clubDto);
        $form->handleRequest($request);
        if (!$form->isSubmitted()) {
            return [null, 'Form is not submitted'];
        }
        if (!$form->isValid()) {
            return [null, $form];
        }

        $club->setName($clubDto->name);
        $club->setbudget($clubDto->budget);
        $this->clubService->save($club);
        return [$club, null];
    }

    public function updateBudgetProcessor(Club $club, Request $request){
        $content = json_decode($request->getContent(), true);
        if(!$this->checkSalariesInClub($club, $content['budget'])){
            return  [null, "Cannot change budget because salaries to pay are greater than new budget"];
        }
        [$club, $error] = $club->patch($content);
        if(!$club){
            return [null, $error];
        }
        $this->clubService->save($club);
        return [$club, null];
    }

    public function checkBudgetInClubForNewSalary(Club $club, People $newPeople){
        $newSalary = $newPeople->getSalary();
        $budget = $club->getBudget();
        $peopleInClub = $this->peopleRepository->findPeopleFromClub($club->getId());
        $totalSalaryToPay = 0;
        foreach($peopleInClub as $people){
            $totalSalaryToPay += $people->getSalary();
        }
        $freeBudget = $budget - $totalSalaryToPay;
        return $freeBudget >= $newSalary;
    }

    public function checkSalariesInClub(Club $club, float $newBudget){
        $peopleInClub = $this->peopleRepository->findPeopleFromClub($club->getId());
        $totalSalaryToPay = 0;
        foreach($peopleInClub as $people){
            $totalSalaryToPay += $people->getSalary();
        }
        return $newBudget >= $totalSalaryToPay;
    }
}
