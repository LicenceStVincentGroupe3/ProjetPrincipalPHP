<?php

namespace App\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        //
        $form = $this->get('form.factory')
            ->createNamedBuilder(null)
            ->add('_username', \Symfony\Component\Form\Extension\Core\Type\EmailType::class, [ 'label' => 'E-mail', 'required' => true,'attr' => ['autofocus' => true] ])
            ->add('_password', \Symfony\Component\Form\Extension\Core\Type\PasswordType::class, ['label' => 'Mot de passe', 'required' => true])
            ->add('ok', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, ['label' => 'Connexion'])
            ->getForm();
        return $this->render('security/login.html.twig', [
            'mainNavLogin' => true, 'title' => 'Connexion',
            //
            'form' => $form->createView(),
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }
}
