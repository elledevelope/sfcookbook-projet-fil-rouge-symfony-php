<?php

namespace App\Form;

use App\Entity\Recipes;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RecipesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('recipe_id')

            ->add('title', TextType::class, [
                'label' => 'Title',
                'constraints' => [
                    new Length([
                        'min' => 2, 
                        'minMessage' => 'The title must be at least {{ limit }} characters!',
                        'max' => 20,
                        'maxMessage' => 'The title cannot be longer than {{ limit }} characters!',
                    ]),
                ],
            ])

            ->add('description')

            ->add('ingredients', TextareaType::class, [
                'label' => 'Ingredients',
                
                'attr' => [
                    'placeholder' => 'example: 
Preheat your oven to 220°C;
Add sliced onions;
... ;',
                    'class' => 'form-control', // Add your form control class if needed
                    'rows' => 10,
                    'cols' => 50,
                ],
                'help' => 'Please separate ingredients with a semicolon (;).',
                'help_attr' => [
                    'class' => 'small-help-text',
                ],
            ])

            ->add('instructions', TextareaType::class, [
                'label' => 'Instructions',
                'attr' => [
                    'placeholder' => 'example: 
700g boneless chicken; 
1/4 cup olive oil;
...;',
                    'class' => 'form-control', // Add your form control class if needed
                    'rows' => 10,
                    'cols' => 50,
                ],
                'help' => 'Please separate instructions with a semicolon (;).',
                'help_attr' => [
                    'class' => 'small-help-text',
                ],
            ])


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
            // ->add('created_at')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipes::class,
        ]);
    }
}
