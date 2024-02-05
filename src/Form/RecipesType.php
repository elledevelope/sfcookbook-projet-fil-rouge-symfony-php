<?php

namespace App\Form;

use App\Entity\Recipes;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;


use Symfony\Component\Validator\Constraints\File;

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

             // Hidden field for author (user)
             ->add('author', HiddenType::class, [
                'mapped' => false, // This field is not mapped to any property
            ])

            ->add('description', TextType::class, [
                'label' => 'Description',
                'constraints' => [
                    new Length([
                        'min' => 5,
                        'minMessage' => 'The description must be at least {{ limit }} characters!',
                        'max' => 500,
                        'maxMessage' => 'The description cannot be longer than {{ limit }} characters!',
                    ]),
                ],
            ])



            ->add('description', TextType::class, [
                'label' => 'Description',
                'constraints' => [
                    new Length([
                        'min' => 5,
                        'minMessage' => 'The description must be at least {{ limit }} characters!',
                        'max' => 500,
                        'maxMessage' => 'The description cannot be longer than {{ limit }} characters!',
                    ]),
                ],
            ])


            ->add('ingredients', TextareaType::class, [
                'label' => 'Ingredients',
                'constraints' => [
                    new Length([
                        'min' => 5,
                        'minMessage' => 'The description must be at least {{ limit }} characters!',
                        'max' => 1000,
                        'maxMessage' => 'The description cannot be longer than {{ limit }} characters!',
                    ]),
                ],
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
                'constraints' => [
                    new Length([
                        'min' => 5,
                        'minMessage' => 'The instructions must be at least {{ limit }} characters!',
                        'max' => 2000,
                        'maxMessage' => 'The instructions cannot be longer than {{ limit }} characters!',
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'example: 
            700g boneless chicken; 
            1/4 cup olive oil;
            ...;',
                    'class' => 'form-control',
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
                    'Easy' => 'Easy',
                    'Medium' => 'Medium',
                    'Hard' => 'Hard',
                ],
                'expanded' => true, // Render as radio buttons
                'multiple' => false, // Allow only one selection
            ])


            ->add('budget', ChoiceType::class, [
                'label' => 'Budget',
                'choices' => [
                    'Low' => 'Low',
                    'Medium' => 'Medium',
                    'High' => 'High',
                ],
                'expanded' => true,
                'multiple' => false,
            ])

            ->add('cuisine', TextType::class, [
                'label' => 'Cuisine',
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'The cuisine must be at least {{ limit }} characters!',
                        'max' => 20,
                        'maxMessage' => 'The cuisine cannot be longer than {{ limit }} characters!',
                    ]),
                ],
            ])

            // FileType for the image field
            ->add('image', FileType::class, [
                'label' => 'Image',
                'required' => true, // true if the image is mandatory
                'data_class' => null, // Allow handling as array

                // 'mapped' => false,  // Indicates that this field is not mapped to any property
                'constraints' => [
                    new File([
                        // 'maxSize' => '7000k',
                        'mimeTypes' => [
                            'image/jpg',
                            'image/jpeg',
                            'image/png',
                            'image/webp',
                            // 'image/gif',
                        ],
                        'mimeTypesMessage' => "This image is not a valid type! Allowed types: jpg, jpeg, png, webp."
                    ])
                ]
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
