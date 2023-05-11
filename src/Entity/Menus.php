<?php

namespace App\Entity;

use App\Repository\MenusRepository;
use Doctrine\DBAL\Types\Types;
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

    #[ORM\ManyToOne(inversedBy: 'menuses')]
    private ?Users $users = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $dish_description = null;

    #[ORM\ManyToOne(inversedBy: 'menus')]
    private ?Categories $categories = null;

    public function getId(): ?int
    {
        return $this -> id;
    }

    public function getDishTitle(): ?string
    {
        return $this -> dish_title;
    }

    public function setDishTitle(string $dish_title): self
    {
        $this -> dish_title = $dish_title;

        return $this;
    }

    public function getDishPrice(): ?int
    {
        return $this -> dish_price;
    }

    public function setDishPrice(int $dish_price): self
    {
        $this -> dish_price = $dish_price;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this -> users;
    }

    public function setUsers(?Users $users): self
    {
        $this -> users = $users;

        return $this;
    }

    public function getDishDescription(): ?string
    {
        return $this -> dish_description;
    }

    public function setDishDescription(?string $dish_description): self
    {
        $this -> dish_description = $dish_description;

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this -> categories;
    }

    public function setCategories(?Categories $categories): self
    {
        $this -> categories = $categories;

        return $this;
    }
}
