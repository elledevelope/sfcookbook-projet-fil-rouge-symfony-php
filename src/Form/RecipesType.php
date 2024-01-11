<?php

namespace App\Form;

use App\Entity\Recipes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class RecipesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('recipe_id')
            ->add('title')
            ->add('description')
            ->add('ingredients')
            ->add('instructions')
            
            // Use ChoiceType as radio buttons
            ->add('level', ChoiceType::class, [
                'label' => 'Level',
                'choices' => [
                    'Easy' => 'easy',
                    'Medium' => 'medium',
                    'Hard' => 'hard',
                ],
                'expanded' => true, // Render as radio buttons
                'multiple' => false, // Allow only one selection
            ])

            ->add('budget', ChoiceType::class, [
                'label' => 'Budget',
                'choices' => [
                    'Low' => 'low',
                    'Medium' => 'medium',
                    'High' => 'high',
                ],
                'expanded' => true,
                'multiple' => false,
            ])

            ->add('cuisine')

            // FileType for the image field
            ->add('image', FileType::class, [
                'label' => 'Image',
                'required' => true, // true if the image is mandatory
                'data_class' => null, // Allow handling as array
            ])            

            // ->add('user_id')
            ->add('created_at')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipes::class,
        ]);
    }
}
