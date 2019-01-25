<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\CompanyBusinessCategory;
use App\AdminBundle\Form\CompanyBusinessCategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Annotation\Groups;

// Préfix url
/**
 * @Route("/company/business/category")
 */
class CompanyBusinessCategoryController extends AbstractController
{
    /**
     * @Route("/new", name="newBusinessCategory", methods={"GET","POST"})
     */
    public function new(Request $request)
    {
        $new = new CompanyBusinessCategory();

        $form = $this->createForm(CompanyBusinessCategoryType::class, $new);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $new = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($new);
            $entityManager->flush();

            return $this->redirectToRoute('listBusinessCategory');
        }

        return $this->render('companyBusinessCategory/new.html.twig', array('form' => $form->createView(),));
    }

    /**
     * @Route("/edit/{id}", name="editBusinessCategory", requirements={"id"="\d+"}, methods={"GET","POST"})
     */
    public function edit($id, Request $request)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        // Variable qui contient le Repository
        $companyActivitySectorRepository = $display->getRepository(CompanyBusinessCategory::class);

        // Equivalent du SELECT * where id=(paramètre)
        $edit = $companyActivitySectorRepository->find($id);

        $form = $this->createForm(CompanyBusinessCategoryType::class, $edit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST')) 
        {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirectToRoute('listBusinessCategory');
        }

        return $this->render('companyBusinessCategory/edit.html.twig', array(
        'form' => $form->createView(),'businessCategory' => $edit
        ));
    }

    /**
     * @Route("/delete/{id}", name="deleteActivitySector", requirements={"id"="\d+"}, methods={"GET","POST"})
     */
    public function delete($id)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        $companyActivitySectorRepository = $display->getRepository(CompanyBusinessCategory::class);

        $delete = $companyActivitySectorRepository->find($id);

        $display->remove($delete);

        $display->flush();

        return $this->redirectToRoute('listBusinessCategory');
    }

    /**
     * @Route("/list", name="listBusinessCategory", methods={"GET"})
     */
    public function list()
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        // Variable qui contient le Repository
        $companyBusinessCategoryRepository = $display->getRepository(CompanyBusinessCategory::class);

        // Equivalent du SELECT *
        $list = $companyBusinessCategoryRepository->findAll();
        // -------------------------------------------------------------
        // On demande à la vue d'afficher la liste des catégories
        // -------------------------------------------------------------
        return $this->render('companyBusinessCategory/list.html.twig', array('lesCategs' => $list)); // On affecte le tableau à la vue
    }
}
