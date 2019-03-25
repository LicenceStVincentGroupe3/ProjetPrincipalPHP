<?php

namespace App\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\AdminBundle\Entity\OperationTypeOperation;
use App\AdminBundle\Form\OperationTypeOperationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\VarDumper;

// Préfix url
/**
 * @Route("/operation/typeOperation")
 */
class OperationTypeOperationController extends AbstractController
{
    /**
     * @Route("/new", methods={"GET","POST"}, name="newOperationTypeOperation")
     */
    public function new(Request $request)
    {
        if ($this->isGranted('ROLE_COMMERCIAL')) {
            $new = new OperationTypeOperation();

            $form = $this->createForm(OperationTypeOperationType::class, $new);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST'))
            {
                $new = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($new);
                $entityManager->flush();

                return $this->redirect($this->generateUrl('listOperationTypeOperation'));
            }

            return $this->render('operation_type_operation/new.html.twig', ['form' => $form->createView()]);
        }
        else {
            return $this->redirect($this->generateUrl('login'));
        }
    }

    /**
     * @Route("/edit/{id}", requirements={"id"="\d+"}, methods={"GET","POST"}, name="editOperationTypeOperation")
     */
    public function edit($id, Request $request)
    {
        if ($this->isGranted('ROLE_COMMERCIAL')) {
            // Appel de Doctrine
            $display = $this->getDoctrine()->getManager();

            // Variable qui contient le Repository
            $operationTypeOperationRepository = $display->getRepository(OperationTypeOperation::class);

            // Equivalent du SELECT * where id=(paramètre)
            $edit = $operationTypeOperationRepository->find($id);

            $form = $this->createForm(OperationTypeOperationType::class, $edit);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST'))
            {
                $entityManager = $this->getDoctrine()->getManager();

                $entityManager->flush();

                return $this->redirect($this->generateUrl('listOperationTypeOperation'));
            }

            // ----------------------------------
            // On demande à la vue d'afficher la commande plus tous ses produits
            // ----------------------------------
            return $this->render('operation_type_operation/edit.html.twig', ['editOTO' => $edit, 'form' => $form->createView()]);
        }
        else {
            return $this->redirect($this->generateUrl('login'));
        }
    }

    /**
     * @Route("/delete/{id}", requirements={"id"="\d+"}, methods={"GET","POST"}, name="deleteOperationTypeOperation")
     */
    public function delete($id)
    {
        if ($this->isGranted('ROLE_COMMERCIAL')) {
            // Appel de Doctrine
            $display = $this->getDoctrine()->getManager();

            $operationTypeOperationRepository = $display->getRepository(OperationTypeOperation::class);

            $delete = $operationTypeOperationRepository->find($id);

            $display->remove($delete);

            $display->flush();

            return $this->redirect($this->generateUrl('listOperationTypeOperation'));
        }
        else {
            return $this->redirect($this->generateUrl('login'));
        }
    }

    /**
     * @Route("/list", name="listOperationTypeOperation", methods={"GET"})
     */
    public function list(Request $request/*, SerializerInterface $serializer*/)
    {
        if ($this->isGranted('ROLE_COMMERCIAL')) {
            // Appel de Doctrine
            $display = $this->getDoctrine()->getManager();

            // Variable qui contient le Repository
            $operationTypeOperationRepository = $display->getRepository(OperationTypeOperation::class);

            // Equivalent du SELECT *
            $list = $operationTypeOperationRepository->findAll();


            // ----------------------------------
            // On demande à la vue d'afficher la liste des commandes
            // ----------------------------------
            return $this->render('operation_type_operation/list.html.twig', ['listOTO' => $list]);
            // On affecte notre tableau contenant la(les) valeur(s) de la variable à la vue
        }
        else {
            return $this->redirect($this->generateUrl('login'));
        }
    }
}
