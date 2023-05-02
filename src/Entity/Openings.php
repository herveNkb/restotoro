<?php

namespace App\Entity;

use App\Repository\OpeningsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OpeningsRepository::class)]
class Openings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $opening_day = null;

    #[ORM\Column(length: 25)]
    private ?string $opening_morning = null;

    #[ORM\Column(length: 25)]
    private ?string $opening_afternoon = null;

    #[ORM\ManyToOne(inversedBy: 'openings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $users = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOpeningDay(): ?string
    {
        return $this->opening_day;
    }

    public function setOpeningDay(string $opening_day): self
    {
        $this->opening_day = $opening_day;

        return $this;
    }

    public function getOpeningMorning(): ?string
    {
        return $this->opening_morning;
    }

    public function setOpeningMorning(string $opening_morning): self
    {
        $this->opening_morning = $opening_morning;

        return $this;
    }

    public function getOpeningAfternoon(): ?string
    {
        return $this->opening_afternoon;
    }

    public function setOpeningAfternoon(string $opening_afternoon): self
    {
        $this->opening_afternoon = $opening_afternoon;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }
}
