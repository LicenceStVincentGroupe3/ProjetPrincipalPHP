<?php

namespace App\Controller;

use App\Entity\CompanyBusinessCategory;
use App\Form\CompanyBusinessCategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * @Route("/company/business/category")
 */
class CompanyBusinessCategoryController extends AbstractController
{
    /**
     * @Route("/new", name="newBusinessCategory")
     */
    public function new(Request $request)
    {
        $newBusinessCategory = new CompanyBusinessCategory();
        $form = $this->createForm(CompanyBusinessCategoryType::class, $newBusinessCategory);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $newBusinessCategory = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newBusinessCategory);
            $entityManager->flush();

            return $this->redirectToRoute('listBusinessCategory');
        }

        return $this->render('companyBusinessCategory/new.html.twig', array('form' => $form->createView(),));
    }

    /**
     * @Route("/edit/{id}", name="editBusinessCategory", requirements={"id"="\d+"})
     */
    public function edit($id, Request $request)
    {
        $editBusinessCategory = $this->getDoctrine()->getManager()->getRepository(CompanyBusinessCategory::class)->find($id);

        $form = $this->createForm(CompanyBusinessCategoryType::class, $editBusinessCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST')) 
        {
            $editBusinessCategory = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirectToRoute('listBusinessCategory');
        }

        return $this->render('companyBusinessCategory/edit.html.twig', array(
        'form' => $form->createView(),'businessCategory' => $editBusinessCategory
        ));
    }

    /**
     * @Route("/delete/{id}", name="deleteActivitySector", requirements={"id"="\d+"})
     */
    public function delete($id)
    {
        $suppBD = $this->getDoctrine()->getManager();

        // On crée un objet, instance de CompanyBusinessCategory
        $suppBusinessCategory = new CompanyBusinessCategory();

        $suppBusinessCategory = $suppBD->getRepository(CompanyBusinessCategory::class)->find($id);

        // Suppression de la catégorie
        $suppBD->remove($suppBusinessCategory);

        // Exécution
        $suppBD->flush();

        return $this->redirectToRoute('listBusinessCategory');
    }

    /**
     * @Route("/list", name="listBusinessCategory")
     */
    public function list()
    {
        // ---------------------------------------
        // Récupération de la liste des catégories
        // ---------------------------------------
        $repository = $this->getDoctrine()->getManager()->getRepository(CompanyBusinessCategory::class);

        $listBusinessCategory = $repository->findAll();
        // -------------------------------------------------------------
        // On demande à la vue d'afficher la liste des catégories
        // -------------------------------------------------------------
        return $this->render('companyBusinessCategory/list.html.twig', array('lesCategs' => $listBusinessCategory)); // On affecte le tableau à la vue
    }
}
