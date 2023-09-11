<?php

namespace App\Service;

use App\Entity\Club;
//use App\Model\Exception\Book\BookNotFound;
use App\Repository\ClubRepository;
use Doctrine\ORM\EntityManagerInterface;

class ClubService
{

    public function __construct(private ClubRepository $clubRepository, private EntityManagerInterface $entityManager )
    {
    }

    public function getAll() {
        return $this->clubRepository->findAll();
    }



    public function getById(int $id){
        return $this->clubRepository->find($id);
    }

    public function create(){
        $club = new Club();
        return $club;
    }

    
    public function save(Club $club) : Club{
        $this->entityManager->persist($club);
        $this->entityManager->flush();
        return $club;
    }

    
    public function delete(Club $club){
        $this->entityManager->remove($club);
        $this->entityManager->flush();
    }
}
    