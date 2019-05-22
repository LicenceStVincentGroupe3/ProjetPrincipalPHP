<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\CompanyStatus;
use App\AdminBundle\Form\CompanyStatusType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * @Route("/company/status")
 */
class CompanyStatusController extends AbstractController
{
    /**
     * @Route("/new", name="newStatus")
     */
    public function new(Request $request)
    {
        $newStatus = new CompanyStatus();
        $form = $this->createForm(CompanyStatusType::class, $newStatus);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $newStatus = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newStatus);
            $entityManager->flush();

            return $this->redirectToRoute('listStatus');
        }

        return $this->render('companyStatus/new.html.twig', array('form' => $form->createView(),));
    }

    /**
     * @Route("/edit/{id}", name="editStatus", requirements={"id"="\d+"})
     */
    public function edit($id, Request $request)
    {
        $editStatus = $this->getDoctrine()->getManager()->getRepository(CompanyStatus::class)->find($id);

        $form = $this->createForm(CompanyStatusType::class, $editStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST')) 
        {
            $editStatus = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirectToRoute('listStatus');
        }

        return $this->render('companyStatus/edit.html.twig', array(
        'form' => $form->createView(),'status' => $editStatus
        ));
    }

    /**
     * @Route("/delete/{id}", name="deleteStatus", requirements={"id"="\d+"})
     */
    public function delete($id)
    {
        $suppBD = $this->getDoctrine()->getManager();

        // On crée un objet, instance de CompanyLegalStatus
        $suppStatus = new CompanyStatus();

        $suppStatus = $suppBD->getRepository(CompanyStatus::class)->find($id);

        // Suppression du statut légal
        $suppBD->remove($suppStatus);

        // Exécution
        $suppBD->flush();

        return $this->redirectToRoute('listStatus');
    }

    /**
     * @Route("/list", name="listStatus")
     */
    public function list()
    {
        // ---------------------------------------
        // Récupération de la liste des status
        // ---------------------------------------
        $repository = $this->getDoctrine()->getManager()->getRepository(CompanyStatus::class);

        $listStatus = $repository->findAll();
        // -------------------------------------------------------------
        // On demande à la vue d'afficher la liste des status
        // -------------------------------------------------------------
        return $this->render('companyStatus/list.html.twig', array('lesStatus' => $listStatus)); // On affecte le tableau à la vue
    }
}
