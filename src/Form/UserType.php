<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints as Assert;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')

            // ->add('roles', ChoiceType::class, [
            //     'choices' => [
            //         'User' => 'ROLE_USER',
            //         'Admin' => 'ROLE_ADMIN',
            //     ],
            //     'multiple' => true, // If a user can have multiple roles
            //     'expanded' => true, // If you want the roles to be checkboxes instead of a select dropdown
            // ])

            ->add('password')

            ->add('username')

            // ->add('about')
            ->add('about', TextType::class, [ // Change to TextType
                'required' => false,
                'attr' => [
                    'maxlength' => 500, // Add maxlength attribute
                ],
                'constraints' => [
                    new Assert\Length([
                        'max' => 500,
                        'maxMessage' => 'The about field cannot be longer than {{ limit }} characters.',
                    ]),
                    new Assert\Regex([
                        'pattern' => '/^[a-zA-Z0-9\s\.,\!\?]+$/',
                        'message' => 'The about field can only contain letters, numbers, spaces, and punctuation.',
                    ]),
                ],
            ])

            ->add('avatar', FileType::class, [
                'label' => 'Avatar',
                'required' => false, // true if the image is mandatory
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
                            'image/svg+xml', // Add SVG MIME type
                            // 'image/gif',
                        ],
                        'mimeTypesMessage' => "This image is not a valid type! Allowed types: jpg, jpeg, png, webp."
                    ])
                ]
            ]);

            // ->add('createdAt');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
