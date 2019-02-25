<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\CompanyActivitySector;
use App\AdminBundle\Form\CompanyActivitySectorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Annotation\Groups;

// Préfix url
/**
 * @Route("/company/activity/sector")
 */
class CompanyActivitySectorController extends AbstractController
{
    /**
     * @Route("/new", methods={"GET","POST"}, name="newActivitySector")
     */
    public function new(Request $request)
    {
        $new = new CompanyActivitySector();

        $form = $this->createForm(CompanyActivitySectorType::class, $new);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $new = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($new);
            $entityManager->flush();

            return $this->redirectToRoute('listActivitySector');
        }

        return $this->render('CompanyActivitySector/new.html.twig', array('form' => $form->createView(),));
    }

    /**
     * @Route("/edit/{id}", name="editActivitySector", methods={"GET","POST"}, requirements={"id"="\d+"})
     */
    public function edit($id, Request $request)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        // Variable qui contient le Repository
        $companyActivitySectorRepository = $display->getRepository(CompanyActivitySector::class);

        // Equivalent du SELECT * where id=(paramètre)
        $edit = $companyActivitySectorRepository->find($id);

        $form = $this->createForm(CompanyActivitySectorType::class, $edit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST')) 
        {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirectToRoute('listActivitySector');
        }

        return $this->render('CompanyActivitySector/edit.html.twig', array(
        'form' => $form->createView(),'activitySector' => $edit
        ));
    }

    /**
     * @Route("/delete/{id}", name="deleteActivitySector", requirements={"id"="\d+"}, methods={"GET","POST"})
     */
    public function delete($id)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        $companyActivitySectorRepository = $display->getRepository(CompanyActivitySector::class);

        $delete = $companyActivitySectorRepository->find($id);

        $display->remove($delete);

        $display->flush();

        return $this->redirectToRoute('listActivitySector');
    }

    /**
     * @Route("/list", name="listActivitySector", methods={"GET"})
     */
    public function list()
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        // Variable qui contient le Repository
        $companyActivitySectorRepository = $display->getRepository(CompanyActivitySector::class);

        // Equivalent du SELECT *
        $list = $companyActivitySectorRepository->findAll();

        // -------------------------------------------------------------
        // On demande à la vue d'afficher la liste des secteurs d'activité
        // -------------------------------------------------------------
        return $this->render('companyActivitySector/list.html.twig', array('lesSecteurs' => $list)); // On affecte le tableau à la vue
    }
}
