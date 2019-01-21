<?php

namespace App\AdminBundle\Controller;

use App\Entity\CompanyCountry;
use App\Form\CompanyCountryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * @Route("/company/country")
 */
class CompanyCountryController extends AbstractController
{
    /**
     * @Route("/new", name="newCountry")
     */
    public function new(Request $request)
    {
        $newCountry = new CompanyCountry();
        $form = $this->createForm(CompanyCountryType::class, $newCountry);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $newCountry = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newCountry);
            $entityManager->flush();

            return $this->redirectToRoute('listCountry');
        }

        return $this->render('companyCountry/new.html.twig', array('form' => $form->createView(),));
    }

    /**
     * @Route("/edit/{id}", name="editCountry", requirements={"id"="\d+"})
     */
    public function edit($id, Request $request)
    {
        $editCountry = $this->getDoctrine()->getManager()->getRepository(CompanyCountry::class)->find($id);

        $form = $this->createForm(CompanyCountryType::class, $editCountry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST')) 
        {
            $editCountry = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirectToRoute('listCountry');
        }

        return $this->render('companyCountry/edit.html.twig', array(
        'form' => $form->createView(),'country' => $editCountry
        ));
    }

    /**
     * @Route("/delete/{id}", name="deleteCountry", requirements={"id"="\d+"})
     */
    public function delete($id)
    {
        $suppBD = $this->getDoctrine()->getManager();

        // On crée un objet, instance de Pays
        $suppCountry = new CompanyCountry();

        $suppCountry = $suppBD->getRepository(CompanyCountry::class)->find($id);

        // Suppression du pays
        $suppBD->remove($suppCountry);

        // Exécution
        $suppBD->flush();

        return $this->redirectToRoute('listCountry');
    }

    /**
     * @Route("/list", name="listCountry")
     */
    public function list()
    {
        // ---------------------------------------
        // Récupération de la liste des pays
        // ---------------------------------------
        $repository = $this->getDoctrine()->getManager()->getRepository(CompanyCountry::class);

        $listCountry = $repository->findAll();
        // -------------------------------------------------------------
        // On demande à la vue d'afficher la liste des pays
        // -------------------------------------------------------------
        return $this->render('companyCountry/list.html.twig', array('lesPays' => $listCountry)); // On affecte le tableau à la vue
    }
}
