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

        return $this->render('favorite_recipes/index.html.twig', [
            'favoriteRecipes' => $favoriteRecipes,
        ]);
    }
}
