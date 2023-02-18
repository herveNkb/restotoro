<?php

namespace App\Entity;

use App\Repository\ReservationsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationsRepository::class)]
class Reservations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_hour = null;

    #[ORM\Column]
    private ?int $customer_number = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $allergies = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDateHour(): ?\DateTimeInterface
    {
        return $this->date_hour;
    }

    public function setDateHour(\DateTimeInterface $date_hour): self
    {
        $this->date_hour = $date_hour;

        return $this;
    }

    public function getCustomerNumber(): ?int
    {
        return $this->customer_number;
    }

    public function setCustomerNumber(int $customer_number): self
    {
        $this->customer_number = $customer_number;

        return $this;
    }

    public function getAllergies(): ?string
    {
        return $this->allergies;
    }

    public function setAllergies(?string $allergies): self
    {
        $this->allergies = $allergies;

        return $this;
    }
}
