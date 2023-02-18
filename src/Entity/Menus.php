<?php

namespace App\Entity;

use App\Repository\MenusRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenusRepository::class)]
class Menus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $dish_title = null;

    #[ORM\Column]
    private ?int $dish_price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDishTitle(): ?string
    {
        return $this->dish_title;
    }

    public function setDishTitle(string $dish_title): self
    {
        $this->dish_title = $dish_title;

        return $this;
    }

    public function getDishPrice(): ?int
    {
        return $this->dish_price;
    }

    public function setDishPrice(int $dish_price): self
    {
        $this->dish_price = $dish_price;

        return $this;
    }
}
