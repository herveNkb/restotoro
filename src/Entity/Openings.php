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
    private ?string $opening_open = null;

    #[ORM\Column(length: 25)]
    private ?string $opening_close = null;

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

    public function getOpeningOpen(): ?string
    {
        return $this->opening_open;
    }

    public function setOpeningOpen(string $opening_open): self
    {
        $this->opening_open = $opening_open;

        return $this;
    }

    public function getOpeningClose(): ?string
    {
        return $this->opening_close;
    }

    public function setOpeningClose(string $opening_close): self
    {
        $this->opening_close = $opening_close;

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
