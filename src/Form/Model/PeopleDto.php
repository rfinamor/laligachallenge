<?php

namespace App\Form\Model;

use App\Entity\People;

class PeopleDto{
    public $name;
    public $lastName;
    public $age;
    public $salary;
    public $clubId;
    public $type;

    public static function createFromPeople(People $people): self
    {
        $dto = new self();
        $dto->name = $people->getName();
        $dto->lastName = $people->getLastName();
        $dto->age = $people->getAge();
        $dto->salary = $people->getSalary();
        $dto->clubId = $people->getClubId();
        $dto->type = $people->getType();

        return $dto;
    }

    public static function createEmpty(): self
    {
        return new self();
    }
}