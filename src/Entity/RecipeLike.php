<?php

namespace App\Entity;

use App\Repository\RecipeLikeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeLikeRepository::class)]
class RecipeLike
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'likes')]
    private ?Recipes $recipes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecipes(): ?Recipes
    {
        return $this->recipes;
    }

    public function setRecipes(?Recipes $recipes): static
    {
        $this->recipes = $recipes;

        return $this;
    }
}
