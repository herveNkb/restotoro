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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLunchOpeningTime(): ?\DateTimeInterface
    {
        return $this->lunchOpeningTime;
    }

    public function setLunchOpeningTime(\DateTimeInterface $lunchOpeningTime): self
    {
        $this->lunchOpeningTime = $lunchOpeningTime;

        return $this;
    }
}
