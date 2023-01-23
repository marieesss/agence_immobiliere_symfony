<?php

namespace App\Controller\Security;

use App\Entity\User;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher): Response
    {
        $user = new User();
        $form= $this->createForm(InscriptionType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


        $user-> setPassword($hasher->hashPassword($user, $user->getPassword()));

        // $passwordForm= $user-> getPassword();
        // $passwordHashed= $hasher->hashPassword($user, $passwordForm);
        // $user->setPassword($passwordHashed);

          $manager->persist($user);
            $manager->flush();

            $this-> addFlash('success', 'Votre profil a été créé');
            return $this->redirectToRoute('app_front');
        }

       return $this->renderForm('security/inscription.html.twig', [
            'formUser'=> $form
        ]);
    }
}
