<?php

namespace App\Entity;

use App\Repository\FavoriteRecipesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FavoriteRecipesRepository::class)]
class FavoriteRecipes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'favoriteRecipes')]
    private ?User $user = null;

    #[ORM\ManyToOne]
    private ?Recipes $recipe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getRecipe(): ?Recipes
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipes $recipe): static
    {
        $this->recipe = $recipe;

        return $this;
    }
}
