<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\CompanyCountry;
use App\AdminBundle\Form\CompanyCountryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Annotation\Groups;

// Préfix url
/**
 * @Route("/company/country")
 */
class CompanyCountryController extends AbstractController
{
    /**
     * @Route("/new", name="newCountry", methods={"GET","POST"})
     */
    public function new(Request $request)
    {
        $new = new CompanyCountry();

        $form = $this->createForm(CompanyCountryType::class, $new);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $new = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($new);
            $entityManager->flush();

            return $this->redirectToRoute('listCountry');
        }

        return $this->render('companyCountry/new.html.twig', array('form' => $form->createView(),));
    }

    /**
     * @Route("/edit/{id}", name="editCountry", requirements={"id"="\d+"}, methods={"GET","POST"})
     */
    public function edit($id, Request $request)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        // Variable qui contient le Repository
        $companyCountryRepository = $display->getRepository(CompanyCountry::class);

        // Equivalent du SELECT * where id=(paramètre)
        $edit = $companyCountryRepository->find($id);

        $form = $this->createForm(CompanyCountryType::class, $edit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST')) 
        {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirectToRoute('listCountry');
        }

        return $this->render('companyCountry/edit.html.twig', array(
        'form' => $form->createView(),'country' => $edit
        ));
    }

    /**
     * @Route("/delete/{id}", name="deleteCountry", requirements={"id"="\d+"}, methods={"GET","POST"})
     */
    public function delete($id)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        $companyCountryRepository = $display->getRepository(CompanyCountry::class);

        $delete = $companyCountryRepository->find($id);

        $display->remove($delete);

        $display->flush();

        return $this->redirectToRoute('listCountry');
    }

    /**
     * @Route("/list", name="listCountry", methods={"GET"})
     */
    public function list()
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        // Variable qui contient le Repository
        $companyCountryRepository = $display->getRepository(CompanyCountry::class);

        // Equivalent du SELECT *
        $list = $companyCountryRepository->findAll();

        // -------------------------------------------------------------
        // On demande à la vue d'afficher la liste des pays
        // -------------------------------------------------------------
        return $this->render('companyCountry/list.html.twig', array('lesPays' => $list)); // On affecte le tableau à la vue
    }
}
