<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminSecuController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function index(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->createForm(InscriptionType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $passwordCrypte = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($passwordCrypte);
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute("accueil");
        }

        return $this->render('admin_secu/inscription.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexion(AuthenticationUtils $util) {
        return $this->render("admin_secu/connexion.html.twig", [
            "lastUserName" => $util->getLastUsername(),
            "error" => $util->getLastAuthenticationError()
        ]);
    }

    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexion() {
        
    }

    
}
