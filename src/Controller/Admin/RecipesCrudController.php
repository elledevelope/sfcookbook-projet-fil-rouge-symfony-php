<?php

namespace App\Controller\Admin;

use App\Entity\Recipes;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RecipesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recipes::class;
    }

    public function configureFields(string $recipe): iterable
    {
        return [
            TextField::new('title'),
            TextField::new('description'),
            TextEditorField::new('ingredients'),
            TextEditorField::new('instructions'),
            TextField::new('level'),
            TextField::new('budget'),
            TextField::new('cuisine'),
            ImageField::new('image')
                ->setBasePath('/uploads')
                ->setUploadDir('public/uploads')
                ->onlyOnForms(),
        ];
    }

    // Helper function to sanitize HTML using stripTags
    private function sanitizeHtml($html)
    {
        // Remove HTML tags and trim white spaces
        return trim(strip_tags($html));
    }

    // Override the updateEntity() method to sanitize all fields before saving
    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        // Sanitize all fields
        $entityInstance->setTitle($this->sanitizeHtml($entityInstance->getTitle()));
        $entityInstance->setDescription($this->sanitizeHtml($entityInstance->getDescription()));
        $entityInstance->setIngredients($this->sanitizeHtml($entityInstance->getIngredients()));
        $entityInstance->setInstructions($this->sanitizeHtml($entityInstance->getInstructions()));
        $entityInstance->setLevel($this->sanitizeHtml($entityInstance->getLevel()));
        $entityInstance->setBudget($this->sanitizeHtml($entityInstance->getBudget()));
        $entityInstance->setCuisine($this->sanitizeHtml($entityInstance->getCuisine()));

        parent::updateEntity($entityManager, $entityInstance);
    }
}
