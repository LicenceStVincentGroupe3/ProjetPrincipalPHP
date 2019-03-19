<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\CompanyLegalStatus;
use App\AdminBundle\Form\CompanyLegalStatusType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * @Route("/company/legalStatus")
 */
class CompanyLegalStatusController extends AbstractController
{
    /**
     * @Route("/new", name="newLegalStatus")
     */
    public function new(Request $request)
    {
        $newLegalStatus = new CompanyLegalStatus();
        $form = $this->createForm(CompanyLegalStatusType::class, $newLegalStatus);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $newLegalStatus = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newLegalStatus);
            $entityManager->flush();

            return $this->redirectToRoute('listLegalStatus');
        }

        return $this->render('companyLegalStatus/new.html.twig', array('form' => $form->createView(),));
    }

    /**
     * @Route("/edit/{id}", name="editLegalStatus", requirements={"id"="\d+"})
     */
    public function edit($id, Request $request)
    {
        $editLegalStatus = $this->getDoctrine()->getManager()->getRepository(CompanyLegalStatus::class)->find($id);

        $form = $this->createForm(CompanyLegalStatusType::class, $editLegalStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST')) 
        {
            $editLegalStatus = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirectToRoute('listLegalStatus');
        }

        return $this->render('companyLegalStatus/edit.html.twig', array(
        'form' => $form->createView(),'legalStatus' => $editLegalStatus
        ));
    }

    /**
     * @Route("/delete/{id}", name="deleteLegalStatus", requirements={"id"="\d+"})
     */
    public function delete($id)
    {
        $suppBD = $this->getDoctrine()->getManager();

        // On crée un objet, instance de CompanyLegalStatus
        $suppBusinessCategory = new CompanyLegalStatus();

        $suppBusinessCategory = $suppBD->getRepository(CompanyLegalStatus::class)->find($id);

        // Suppression du statut légal
        $suppBD->remove($suppBusinessCategory);

        // Exécution
        $suppBD->flush();

        return $this->redirectToRoute('listLegalStatus');
    }

    /**
     * @Route("/list", name="listLegalStatus")
     */
    public function list()
    {
        // ---------------------------------------
        // Récupération de la liste des status
        // ---------------------------------------
        $repository = $this->getDoctrine()->getManager()->getRepository(CompanyLegalStatus::class);

        $listLegalStatus = $repository->findAll();
        // -------------------------------------------------------------
        // On demande à la vue d'afficher la liste des status
        // -------------------------------------------------------------
        return $this->render('companyLegalStatus/list.html.twig', array('lesStatus' => $listLegalStatus)); // On affecte le tableau à la vue
    }
}
