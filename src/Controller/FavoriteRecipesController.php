<?php

namespace App\Controller;

use App\Entity\FavoriteRecipes;
use App\Entity\Recipes; 
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavoriteRecipesController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/favorites', name: 'app_favorites_index', methods: ['GET'])]
    public function favoritesIndex(): Response
    {        
        $user = $this->getUser();     
        $favoriteRecipes = $this->entityManager->getRepository(FavoriteRecipes::class)->findBy(['user' => $user]);

        // Calculate isFavorite status for each favorite recipe
        foreach ($favoriteRecipes as $favoriteRecipe) {
            $favoriteRecipe->isFavorite = true; // Assuming all favorite recipes are marked as favorite
        }

        return $this->render('favorite_recipes/index.html.twig', [
            'favoriteRecipes' => $favoriteRecipes,
        ]);
    }

    #[Route('/remove-from-favorites/{id}', name: 'remove_from_favorites', methods: ['DELETE'])]
    public function removeFavorite(Request $request, Recipes $recipe): JsonResponse
    {
        $currentUser = $this->getUser();
        if (!$currentUser) {
            return new JsonResponse(['error' => 'User is not authenticated'], JsonResponse::HTTP_UNAUTHORIZED);
        }

        if (!$recipe) {
            return new JsonResponse(['error' => 'Recipe not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $favoriteRecipe = $this->entityManager->getRepository(FavoriteRecipes::class)
            ->findOneBy(['user' => $currentUser, 'recipe' => $recipe]);

        if ($favoriteRecipe) {
            $this->entityManager->remove($favoriteRecipe);
            $this->entityManager->flush();

            return new JsonResponse(['success' => true]);
        }

        return new JsonResponse(['success' => false]);
    }
}
