<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\LoginAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, LoginAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        // Création d'une nouvelle instance utilisateur
        $user = new User();

        // Création du formulaire de registre
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        // Vérification si le formulaire a été soumis et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistrement de la date de création de l'utilisateur
            $created = new \DateTimeImmutable();
            $user->setCreatedAt($created);
            // Attribution du rôle 'ROLE_USER' par défaut lors de l'enregistrement
            $user->setRoles(['ROLE_USER']);

            // Encodage du mot de passe
            $user->setPassword(
                // Utilisation de l'interface UserPasswordHasherInterface pour sécuriser le mot de passe
                $userPasswordHasher->hashPassword(
                    // Utilisateur concerné
                    $user,
                    // Récupération du mot de passe depuis le formulaire
                    $form->get('password')->getData()
                )
            );

            // Persistance de l'utilisateur en base de données
            $entityManager->persist($user);
            $entityManager->flush();
            // Effectuer d'autres actions si nécessaire, comme l'envoi d'un e-mail

            // Authentification de l'utilisateur et redirection
            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        // Rendu du formulaire de registre
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
