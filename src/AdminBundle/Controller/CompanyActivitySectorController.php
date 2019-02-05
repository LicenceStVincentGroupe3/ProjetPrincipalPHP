<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\CompanyActivitySector;
use App\AdminBundle\Form\CompanyActivitySectorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * @Route("/company/activity/sector")
 */
class CompanyActivitySectorController extends AbstractController
{
    /**
     * @Route("/new", name="newActivitySector")
     */
    public function new(Request $request)
    {
        $newActivitySector = new CompanyActivitySector();
        $form = $this->createForm(CompanyActivitySectorType::class, $newActivitySector);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $newActivitySector = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newActivitySector);
            $entityManager->flush();

            return $this->redirectToRoute('listActivitySector');
        }

        return $this->render('CompanyActivitySector/new.html.twig', array('form' => $form->createView(),));
    }

    /**
     * @Route("/edit/{id}", name="editActivitySector", requirements={"id"="\d+"})
     */
    public function edit($id, Request $request)
    {
        $editActivitySector = $this->getDoctrine()->getManager()->getRepository(CompanyActivitySector::class)->find($id);

        $form = $this->createForm(CompanyActivitySectorType::class, $editActivitySector);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST')) 
        {
            $editActivitySector = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirectToRoute('listActivitySector');
        }

        return $this->render('CompanyActivitySector/edit.html.twig', array(
        'form' => $form->createView(),'activitySector' => $editActivitySector
        ));
    }

    /**
     * @Route("/delete/{id}", name="deleteActivitySector", requirements={"id"="\d+"})
     */
    public function delete($id)
    {
        $suppBD = $this->getDoctrine()->getManager();

        // On crée un objet, instance de CompanyActivitySector
        $suppActivitySector = new CompanyActivitySector();

        $suppActivitySector = $suppBD->getRepository(CompanyActivitySector::class)->find($id);

        // Suppression de l'activité
        $suppBD->remove($suppActivitySector);

        // Exécution
        $suppBD->flush();

        return $this->redirectToRoute('listActivitySector');
    }

    /**
     * @Route("/list", name="listActivitySector")
     */
    public function list()
    {
        // ---------------------------------------
        // Récupération de la liste des secteurs d'activités
        // ---------------------------------------
        $repository = $this->getDoctrine()->getManager()->getRepository(CompanyActivitySector::class);

        $listSectorActivity = $repository->findAll();
        // -------------------------------------------------------------
        // On demande à la vue d'afficher la liste des secteurs d'activité
        // -------------------------------------------------------------
        return $this->render('companyActivitySector/list.html.twig', array('lesSecteurs' => $listSectorActivity)); // On affecte le tableau à la vue
    }
}
