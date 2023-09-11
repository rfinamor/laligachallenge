<?php

namespace App\Entity;

use App\Repository\PeopleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PeopleRepository::class)]
class People
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(nullable: true)]
    private ?int $age = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: '0')]
    private ?string $salary = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(nullable: true)]
    private ?int $clubId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getSalary(): ?string
    {
        return $this->salary;
    }

    public function setSalary(string $salary): static
    {
        $this->salary = $salary;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getClubId(): ?int
    {
        return $this->clubId;
    }

    public function setClubId(?int $clubId): static
    {
        $this->clubId = $clubId;

        return $this;
    }

    public function patch(array $data = []): array{
        if(array_key_exists('clubId', $data)){
            if($data['clubId'] === null){
                return [null, "Adding member to club should contain clubId and it cannot be null"];
            }
            $clubId = $data['clubId'];
            $this->clubId = $clubId;
        }else{
            $this->clubId = null;
        }
        return [$this, null];
    }
}
