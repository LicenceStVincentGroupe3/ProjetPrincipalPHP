<?php

namespace App\Controller;

use App\Entity\OperationTypeOperation;
use App\Form\OperationTypeOperationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
/*use App\Controller\SerializerInterface;
use Symfony\Component\Serializer\Annotation\Groups;*/

// Préfix url
//* @Groups({"Light"})
//* @MaxDepth(1)
/**
 * @Route("/operation/typeOperation")
 */
class OperationTypeOperationController extends AbstractController
{
    /* ---------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    */

    /**
     * @Route("/new", methods={"GET","POST"}, name="newOperationTypeOperation")
     */
    public function new(Request $request)
    {
    	$newOperationTypeOperation = new OperationTypeOperation();

    	$form = $this->createForm(OperationTypeOperationType::class, $newOperationTypeOperation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST'))
        {
            $newOperationTypeOperation = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newOperationTypeOperation);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('listOperationTypeOperation'));
        }

        return $this->render('operation_type_operation/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/", methods={"POST"})
     */
    /*public function newApi(Request $request, SerializerInterface $serializer)
    {
        $json = $serializer->serialize(
            $operationTypeOperation,
            'json',
            ['groups'=>["Light"]]
        );

        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-type', 'application/JSON');

        return $response;
    }*/

    /* ---------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    */

    /**
     * @Route("/edit/{id}", requirements={"id"="\d+"}, methods={"GET","POST"}, name="editOperationTypeOperation")
     */
    public function edit($id, Request $request)
    {
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
            $edit = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirect($this->generateUrl('listOperationTypeOperation'));
        }

        // ----------------------------------
        // On demande à la vue d'afficher la commande plus tous ses produits
        // ----------------------------------
        return $this->render('operation_type_operation/edit.html.twig', ['editOTO' => $edit, 'form' => $form->createView()]);
    }

    /**
     * @Route("/", requirements={"id"="\d+"}, methods={"POST"})
     */
    /*public function editApi($id, Request $request, SerializerInterface $serializer)
    {
        $json = $serializer->serialize(
            $operationTypeOperation,
            'json',
            ['groups'=>["Light"]]
        );

        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-type', 'application/JSON');

        return $response;
    }*/

    /* ---------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    */

    /**
     * @Route("/delete/{id}", requirements={"id"="\d+"}, methods={"GET","POST"}, name="deleteOperationTypeOperation")
     */
    public function delete($id)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        $operationTypeOperationRepository = $display->getRepository(OperationTypeOperation::class);

        $delete = $operationTypeOperationRepository->find($id);

        $display->remove($delete);

        $display->flush();

        return $this->redirect($this->generateUrl('listOperationTypeOperation'));
    }

    /**
     * @Route("/", requirements={"id"="\d+"}, methods={"GET","POST"})
     */
    /*public function deleteApi($id, SerializerInterface $serializer)
    {
        $json = $serializer->serialize(
            $operationTypeOperation,
            'json',
            ['groups'=>["Light"]]
        );

        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-type', 'application/JSON');

        return $response;
    }*/

    /* ---------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    */

    /**
     * @Route("/list", name="listOperationTypeOperation", methods={"GET"})
     */
    public function list(Request $request/*, SerializerInterface $serializer*/)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        // Variable qui contient le Repository
        $operationTypeOperationRepository = $display->getRepository(OperationTypeOperation::class);

        // Equivalent du SELECT *
        $list = $operationTypeOperationRepository->findAll();

        /*if ($request->isXmlHttpRequest()) {
            $json = $serializer->serialize(
                $operationTypeOperation,
                'json',
                ['groups'=>["Light"]]
            );

            $response = new Response();
            $response->setContent($json);
            $response->headers->set('Content-type', 'application/JSON');

            return $response;
        }*/
        //else {
            // ----------------------------------
            // On demande à la vue d'afficher la liste des commandes
            // ----------------------------------
            return $this->render('operation_type_operation/list.html.twig', ['listOTO' => $list]);
            // On affecte notre tableau contenant la(les) valeur(s) de la variable à la vue
        //}
    }
}
