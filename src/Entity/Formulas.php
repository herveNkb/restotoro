<?php

namespace App\Entity;

use App\Repository\FormulasRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormulasRepository::class)]
class Formulas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $formula_title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $formula_price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFormulaTitle(): ?string
    {
        return $this->formula_title;
    }

    public function setFormulaTitle(string $formula_title): self
    {
        $this->formula_title = $formula_title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getFormulaPrice(): ?int
    {
        return $this->formula_price;
    }

    public function setFormulaPrice(int $formula_price): self
    {
        $this->formula_price = $formula_price;

        return $this;
    }
}
