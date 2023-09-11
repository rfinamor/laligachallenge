<?php

namespace App\Service;

use App\Entity\People;
//use App\Model\Exception\Book\BookNotFound;
use App\Repository\PeopleRepository;
use Doctrine\ORM\EntityManagerInterface;

class PeopleService
{

    public function __construct(private PeopleRepository $peopleRepository, private EntityManagerInterface $entityManager )
    {
    }

    public function getAll() {
        return $this->peopleRepository->findAll();
    }



    public function getById(int $id){
        return $this->peopleRepository->find($id);
    }

    public function create(){
        $people = new People();
        return $people;
    }

    
    public function save(People $people) : People{
        $this->entityManager->persist($people);
        $this->entityManager->flush();
        return $people;
    }

    
    public function delete(People $people){
        $this->entityManager->remove($people);
        $this->entityManager->flush();
    }
}
    