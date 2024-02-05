<?php

namespace App\Controller\Admin;

use App\Entity\Recipes;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
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
        ];
    }
    
}