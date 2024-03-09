<?php

namespace App\Controller;

use App\Entity\FavoriteRecipes;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavoriteRecipesController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    // #[Route('/favorite/recipes', name: 'app_favorite_recipes')]
    // public function index(): Response
    // {
    //     return $this->render('favorite_recipes/index.html.twig', [
    //         'controller_name' => 'FavoriteRecipesController',
    //     ]);
    // }


    #[Route('/favorites', name: 'app_favorites_index', methods: ['GET'])]
    public function favoritesIndex(): Response
    {        
        $user = $this->getUser();     
        $favoriteRecipes = $this->entityManager->getRepository(FavoriteRecipes::class)->findBy(['user' => $user]);

        // Calculate isFavorite status for each favorite recipe
        foreach ($favoriteRecipes as $favoriteRecipe) {
            $favoriteRecipe->isFavorite = true; // Assuming all favorite recipes are marked as favorite
            // You can add logic to check if it's a favorite for the current user if needed
        }

        return $this->render('favorite_recipes/index.html.twig', [
            'favoriteRecipes' => $favoriteRecipes,
        ]);
    }
}
