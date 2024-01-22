<?php

namespace App\Controller;

use App\Entity\Recipes;
use App\Form\RecipesType;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\RecipesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// use App\Entity\Users;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use \Gumlet\ImageResize;

#[Route('/recipes')]
class RecipesController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_recipes_index', methods: ['GET'])]
    public function index(RecipesRepository $recipesRepository, PaginatorInterface $paginator, Request $request): Response
    {
        // $recipes = $recipesRepository->findBy([], ['created_at' => 'DESC']);
        $recipes = $paginator->paginate(
            $recipesRepository->findBy([], ['id' => 'DESC']),
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        return $this->render('recipes/index.html.twig', [
            'recipes' => $recipes,
        ]);
    }

    #[Route('/new', name: 'app_recipes_new', methods: ['GET', 'POST'])]
public function new(Request $request, EntityManagerInterface $entityManager): Response
{
    $recipe = new Recipes();
    $form = $this->createForm(RecipesType::class, $recipe);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Persist the entity to generate the ID
        $entityManager->persist($recipe);
        $entityManager->flush();

        // Now the entity has an ID
        $entityId = $recipe->getId();
        $file = $form['image']->getData();
        if ($file) {
            $newFilename = 'recipe_' . $entityId . '.' . $file->guessExtension();

            // Move the file to the desired directory
            try {
                $file->move(
                    $this->getParameter('upload_directory'),
                    $newFilename
                );

                // Set the image property of the recipe entity to the filename
                $recipe->setImage($newFilename);

                // Persist the changes to the entity
                $entityManager->persist($recipe);
                $entityManager->flush();
            } catch (FileException $e) {
                // Handle file upload error
                // Log the error or display a message
                $this->addFlash('error', 'Error uploading the file.');
            }
        }

        return $this->redirectToRoute('app_recipes_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->render('recipes/new.html.twig', [
        'recipe' => $recipe,
        'form' => $form,
    ]);
}



    #[Route('/{id}', name: 'app_recipes_show', methods: ['GET'])]
    public function show(Recipes $recipe): Response
    {
        // Fetch user information based on user_id from the recipe
        // $user = $this->getDoctrine()->getRepository(Users::class)->find($recipe->getUserId());

        // $userRepository = $this->entityManager->getRepository(Users::class);
        // $user = $userRepository->find($recipe->getUserId());

        return $this->render('recipes/show.html.twig', [
            'recipe' => $recipe,
            // 'user' => $user,
        ]);
    }

    //original code:
    // #[Route('/{id}/edit', name: 'app_recipes_edit', methods: ['GET', 'POST'])]
    // public function edit(Request $request, Recipes $recipe, EntityManagerInterface $entityManager): Response
    // {
    //     $form = $this->createForm(RecipesType::class, $recipe);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_recipes_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('recipes/edit.html.twig', [
    //         'recipe' => $recipe,
    //         'form' => $form,
    //     ]);
    // }

    //added 10.01.2024:
    #[Route('/{id}/edit', name: 'app_recipes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Recipes $recipe, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RecipesType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Check if a new image file was uploaded
            $newImage = $form['image']->getData();

            if ($newImage instanceof UploadedFile) {
                // Handle file upload
                $originalFilename = pathinfo($newImage->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename . '-' . uniqid() . '.' . $newImage->guessExtension();

                // Move the file to the desired directory
                try {
                    $newImage->move(
                        $this->getParameter('upload_directory'),
                        $newFilename
                    );

                    // Set the image property of the recipe entity to the new filename
                    $recipe->setImage($newFilename);
                } catch (FileException $e) {
                    // Handle file upload error
                    // Log the error or display a message
                    $this->addFlash('error', 'Error uploading the file.');
                }
            }

            // Continue with the rest of the form submission logic
            $entityManager->flush();

            return $this->redirectToRoute('app_recipes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recipes/edit.html.twig', [
            'recipe' => $recipe,
            'form' => $form->createView(), // Note: Create the form view using createView() method
        ]);
    }



    #[Route('/{id}', name: 'app_recipes_delete', methods: ['POST'])]
    public function delete(Request $request, Recipes $recipe, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $recipe->getId(), $request->request->get('_token'))) {
            $entityManager->remove($recipe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_recipes_index', [], Response::HTTP_SEE_OTHER);
    }
}
