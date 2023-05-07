<?php

namespace App\Controller;


use App\Form\EditProfileType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UsersRepository;

class ProfileController extends AbstractController
{
    #[Route('/mon-compte', name: 'app_profile')]
    public function index(): Response
    {
        return $this -> render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }

    // Profile modification (excluding password)
    #[Route('/mon-compte/modifier', name: 'app_profile_edit')]
    public function editProfile(Request $request, ManagerRegistry $doctrine, UsersRepository $userRepository): Response
    {
        // Logged-in user recovery
        $user = $this -> getUser();

        // Retrieving user data from database
        $userRepository -> find($user -> getId());

        // Creation of the form
        $form = $this -> createForm(EditProfileType::class, $user);
        // Form processing
        $form -> handleRequest($request);

        // If the form is submitted and valid
        if ($form -> isSubmitted() && $form -> isValid()) {
            // Retrieving form data
            $user = $form -> getData();

            // Save and send data in database
            $doctrine -> getManager() -> persist($user);
            $doctrine -> getManager() -> flush();

            $this -> addFlash('success', 'Votre profil a bien été modifié');

            return $this -> redirectToRoute('app_profile');

        }

        return $this -> render('profile/editProfile.html.twig', [
            'controller_name' => 'ProfileController',
            'form' => $form -> createView(),
        ]);
    }


    // Change password
    #[Route('/mon-compte/modifier/mot-de-passe', name: 'app_profile_edit_password')]
    public function editPassword(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher): Response
    {
        // Logged-in user recovery
        $user = $this -> getUser();

        // Form processing
        // If the form is submitted and valid (we check that the two passwords are identical)
        if ($request -> isMethod('POST')) {
            // Verification that the two passwords are identical
            if ($request -> request -> get('password') == $request -> request -> get('password2')) {
                // Password recovery and hash
                $user -> setPassword($passwordHasher -> hashPassword($user, $request -> request -> get('password')));
                // Save and send data in database
                $doctrine -> getManager() -> persist($user);
                $doctrine -> getManager() -> flush();

                $this -> addFlash('success', 'Votre mot de passe a bien été modifié');

                return $this -> redirectToRoute('app_profile');

            } else {
                $this -> addFlash('danger', 'Les mots de passe ne correspondent pas');
            }
        }

        return $this -> render('profile/editPassword.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }
}
