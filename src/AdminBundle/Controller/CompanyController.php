<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\Company;
use App\AdminBundle\Form\CompanyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Annotation\Groups;

// Préfix url
/**
 * @Route("/company")
 */
class CompanyController extends AbstractController
{
    /**
     * @Route("/new", methods={"GET","POST"}, name="newCompany")
     */
    public function new(Request $request)
    {
        $new = new Company();

        $form = $this->createForm(CompanyType::class, $new);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $new = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($new);
            $entityManager->flush();


            return $this->redirectToRoute('listCompany');
        }
        return $this->render('company/new.html.twig', array('form' => $form->createView(),));
    }

    /**
     * @Route("/edit/{id}", name="editCompany", requirements={"id"="\d+"}, methods={"GET","POST"})
     */
    public function edit($id, Request $request)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        // Variable qui contient le Repository
        $companyRepository = $display->getRepository(Company::class);

        // Equivalent du SELECT * where id=(paramètre)
        $edit = $companyRepository->find($id);

        $form = $this->createForm(CompanyType::class, $edit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST')) 
        {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirectToRoute('listCompany');
        }

        return $this->render('company/edit.html.twig', array(
        'form' => $form->createView(),'company' => $edit
        ));
    }

    /**
     * @Route("/delete/{id}", name="deleteCompany", requirements={"id"="\d+"}, methods={"GET","POST"})
     */
    public function delete($id)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        $companyRepository = $display->getRepository(Company::class);

        $delete = $companyRepository->find($id);

        $display->remove($delete);

        $display->flush();

        return $this->redirectToRoute('listCompany');
    }

    /**
     * @Route("/list", name="listCompany", methods={"GET"})
     */
    public function list()
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        // Variable qui contient le Repository
        $companyRepository = $display->getRepository(Company::class);

        // Equivalent du SELECT *
        $list = $companyRepository->findAll();

        // -------------------------------------------------------------
        // On demande à la vue d'afficher la liste des entreprises
        // -------------------------------------------------------------
        return $this->render('company/list.html.twig', array('lesEntreprises' => $list)); // On affecte le tableau à la vue
    }
}
