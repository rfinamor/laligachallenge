<?php

namespace App\Form\Model;

use App\Entity\Club;

class ClubDto{
    public ?string $name;
    public ?float $budget;

    public static function createFromClub(Club $club): self
    {
        $dto = new self();
        $dto->name = $club->getName();
        $dto->budget = $club->getBudget();
        return $dto;
    }

    public static function createEmpty(): self
    {
        return new self();
    }
}