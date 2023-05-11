<?php

namespace App\Entity;

use App\Repository\ReservationsSettingsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationsSettingsRepository::class)]
class ReservationsSettings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $lunchOpeningTime = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $lunchClosingTime = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $dinnerOpeningTime = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $dinnerClosingTime = null;

    #[ORM\Column]
    private ?int $maxCustomers = null;

    public function getId(): ?int
    {
        return $this -> id;
    }

    public function getLunchOpeningTime(): ?\DateTimeInterface
    {
        return $this -> lunchOpeningTime;
    }

    public function setLunchOpeningTime(\DateTimeInterface $lunchOpeningTime): self
    {
        $this -> lunchOpeningTime = $lunchOpeningTime;

        return $this;
    }

    public function getLunchClosingTime(): ?\DateTimeInterface
    {
        return $this -> lunchClosingTime;
    }

    public function setLunchClosingTime(\DateTimeInterface $lunchClosingTime): self
    {
        $this -> lunchClosingTime = $lunchClosingTime;

        return $this;
    }

    public function getDinnerOpeningTime(): ?\DateTimeInterface
    {
        return $this -> dinnerOpeningTime;
    }

    public function setDinnerOpeningTime(\DateTimeInterface $dinnerOpeningTime): self
    {
        $this -> dinnerOpeningTime = $dinnerOpeningTime;

        return $this;
    }

    public function getDinnerClosingTime(): ?\DateTimeInterface
    {
        return $this -> dinnerClosingTime;
    }

    public function setDinnerClosingTime(\DateTimeInterface $dinnerClosingTime): self
    {
        $this -> dinnerClosingTime = $dinnerClosingTime;

        return $this;
    }

    public function getMaxCustomers(): ?int
    {
        return $this -> maxCustomers;
    }

    public function setMaxCustomers(int $maxCustomers): self
    {
        $this -> maxCustomers = $maxCustomers;

        return $this;
    }

    public function getMaxCustomersPerDay(): ?int
    {

        return $this -> maxCustomers;
    }
}
