<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                // 'attr' => [
                //     'placeholder' => 'Email',
                // ],
            ])

            ->add('username', TextType::class, [
                // 'attr' => [
                //     'placeholder' => 'Username',
                // ],
            ])

            ->add('agreeTerms', CheckboxType::class, [
                'attr' => [
                    'class' => 'agreeToTerms',
                ],
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('password', RepeatedType::class, [
                // Définition du type de champ comme un champ de mot de passe
                'type' => PasswordType::class,
                // Message d'erreur en cas de non-correspondance entre les champs de mot de passe
                'invalid_message' => 'The password fields must match.',
                // Options supplémentaires pour le champ
                'options' => ['attr' => ['class' => 'password-field']],
                // Le champ est requis
                'required' => true,
                // Options pour le premier champ de mot de passe
                'first_options'  => ['label' => 'Password'],
                // Options pour le deuxième champ de mot de passe (confirmation)
                'second_options' => ['label' => 'Repeat the password'],
            ]);
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
