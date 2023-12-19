<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\UserAuthenticator;
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
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, 
    UserAuthenticatorInterface $userAuthenticator, UserAuthenticator $authenticator, 
    EntityManagerInterface $entityManager): Response
    {
        // Crée une nouvelle instance de la classe "User" et l'assigne à la variable "$user". 
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        
        // Gère la soumission du formulaire. Si le formulaire a été soumis avec succès et qu'il est valide, 
        // elle extrait le mot de passe en clair du formulaire, 
        // le hache, 
        // puis l'assigne à l'utilisateur en cours de création.
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $this->addFlash(
               'success',
               'Votre compte a bien été créé. '
            );

            // Signifie que l'utilisateur est maintenant enregistré dans la base de données.
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            // Cette ligne utilise un authentificateur d'utilisateur pour authentifier l'utilisateur nouvellement créé. 
            // Elle prend l'utilisateur, 
            // l'authentificateur et la requête en cours en tant que paramètres et retourne un résultat d'authentification.
            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
