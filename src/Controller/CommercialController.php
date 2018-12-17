<?php

namespace App\Controller;

use App\Entity\Commercial;
use App\Form\CommercialType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

// Préfix url
/**
 * @Route("/commercial")
 */
class CommercialController extends AbstractController
{
    /**
     * @Route("/new", name="newCommercial")
     */
    public function new(Request $request)
    {
    	$newCommercial = new Commercial();

    	$form = $this->createForm(CommercialType::class, $newCommercial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST'))
        {
        	$newCommercial = $form->getData();

        	$entityManager = $this->getDoctrine()->getManager();
        	$entityManager->persist($newCommercial);
        	$entityManager->flush();

            return $this->redirect($this->generateUrl('listCommercial'));
        }

        return $this->render('commercial/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/edit/{id}", name="editCommercial")
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
     * @Route("/delete/{id}", name="deleteCommercial")
     */
    public function delete()
    {
        return $this->render('commercial/delete.html.twig', ['controller_name' => 'CommercialController']);
    }

    /**
     * @Route("/list", name="listCommercial")
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
