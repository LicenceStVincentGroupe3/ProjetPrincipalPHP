<?php

namespace App\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\AdminBundle\Entity\Commercial;
use App\AdminBundle\Form\CommercialType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

// Préfix url
/**
 * @Route("/commercial")
 */
class CommercialController extends AbstractController
{
    /**
     * @Route("/new", methods={"GET","POST"}, name="newCommercial")
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
    	$new = new Commercial();

    	$form = $this->createForm(CommercialType::class, $new);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST'))
        {
            $new = $form->getData();
            $password = $passwordEncoder->encodePassword($new, $new->getPlainPassword());
            
            $new->setPassword($password);
            $new->addRole("ROLE_COMMERCIAL");

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($new);
            $entityManager->flush();
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $this->addFlash('success', 'Votre compte à bien été enregistré.');
            //return $this->redirectToRoute('login');

            return $this->redirect($this->generateUrl('listCommercial'));
        }

        return $this->render('commercial/new.html.twig', ['form' => $form->createView(), 'mainNavRegistration' => true]);
    }

    /**
     * @Route("/edit/{id}", requirements={"id"="\d+"}, methods={"GET","POST"}, name="editCommercial")
     */
    public function edit($id, Request $request)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        // Variable qui contient le Repository
        $commercialRepository = $display->getRepository(Commercial::class);

        // Equivalent du SELECT * where id=(paramètre)
        $edit = $commercialRepository->find($id);

        $form = $this->createForm(CommercialType::class, $edit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST'))
        {
            $edit = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $edit->setCommercialLastUpdate(new \DateTime());

            $entityManager->flush();

            return $this->redirect($this->generateUrl('listCommercial'));
        }

        // ----------------------------------
        // On demande à la vue d'afficher la commande plus tous ses produits
        // ----------------------------------
        return $this->render('commercial/edit.html.twig', ['editCom' => $edit, 'form' => $form->createView()]);
    }

    /**
     * @Route("/delete/{id}", requirements={"id"="\d+"}, methods={"GET","POST"}, name="deleteCommercial")
     */
    public function delete($id)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        $commercialRepository = $display->getRepository(Commercial::class);

        $delete = $commercialRepository->find($id);

        $display->remove($delete);

        $display->flush();

        return $this->redirect($this->generateUrl('listCommercial'));
    }

    /**
     * @Route("/list", name="listCommercial", methods={"GET"})
     */
    public function list()
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        // Variable qui contient le Repository
        $commercialRepository = $display->getRepository(Commercial::class);

        // Equivalent du SELECT *
        $list = $commercialRepository->findAll();

        // ----------------------------------
        // On demande à la vue d'afficher la liste des commandes
        // ----------------------------------
        return $this->render('commercial/list.html.twig', ['listCom' => $list]);
        // On affecte notre tableau contenant la(les) valeur(s) de la variable à la vue
    }
}
