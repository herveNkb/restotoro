<?php

namespace App\Controller;


use App\Form\EditProfileType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/mon-compte', name: 'app_profile')]
    public function index(): Response
    {
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }

    // Modification du profil (hors mot de passe)
    #[Route('/mon-compte/modifier', name: 'app_profile_edit')]
    public function editProfile(Request $request, ManagerRegistry $doctrine): Response
    {
        // Récupération de l'utilisateur connecté
        $user = $this->getUser();
        // Création du formulaire
        $form = $this->createForm(EditProfileType::class, $user);
        // Traitement du formulaire
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()){
            // On récupère les données du formulaire
            $user = $form->getData();

            // On enregistre les données en BDD
            $doctrine->getManager()->persist($user);
            // On envoie les données en BDD
            $doctrine->getManager()->flush();

            // On affiche un message de confirmation
            $this->addFlash('success', 'Votre profil a bien été modifié');

            // On redirige vers la page de profil
            return $this->redirectToRoute('app_profile');

        }

        return $this->render('profile/editProfile.html.twig', [
            'controller_name' => 'ProfileController',
            'form' => $form->createView(),
        ]);
    }


    // Modification du mot de passe
    #[Route('/mon-compte/modifier/mot-de-passe', name: 'app_profile_edit_password')]
    public function editPassword(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher): Response
    {
        // Récupération de l'utilisateur connecté
        $user = $this->getUser();

        // Traitement du formulaire
        // Si le formulaire est soumis et valide (on vérifie que les deux mots de passe sont identiques)
        if($request -> isMethod('POST')) {

            // On récupère les données du formulaire
            $user = $this->getUser();
            // On vérifie que les deux mots de passe sont identiques
            if($request->request->get('password') == $request->request->get('password2')) {
                // On récupère le mot de passe et on le hash
                $user->setPassword($passwordHasher->hashPassword($user, $request->request->get('password')));
                // On enregistre les données en BDD
                $doctrine->getManager()->persist($user);
                // On envoie les données en BDD
                $doctrine->getManager()->flush();
                $this->addFlash('success', 'Votre mot de passe a bien été modifié');
                return $this->redirectToRoute('app_profile');


            } else {
                $this->addFlash('danger', 'Les mots de passe ne correspondent pas');
            }


            $doctrine->getManager()->persist($user);
        }


        return $this->render('profile/editPassword.html.twig', [
            'controller_name' => 'ProfileController',
//            'form' => $form->createView(),
        ]);
    }
}
