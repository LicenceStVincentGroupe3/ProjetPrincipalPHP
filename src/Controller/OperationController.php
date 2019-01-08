<?php

namespace App\Controller;

use App\Entity\Operation;
use App\Form\OperationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\VarDumper\VarDumper;

// Préfix url
//* @Groups({"Light"})
//* @MaxDepth(1)
/**
 * @Route("/operation")
 */
class OperationController extends AbstractController
{
    /* ---------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    */

    /**
     * @Route("/new", methods={"GET","POST"}, name="newOperation")
     */
    public function new(Request $request)
    {
    	$newOperation = new Operation();

    	$form = $this->createForm(OperationType::class, $newOperation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST'))
        {
        	$newOperation = $form->getData();

        	$entityManager = $this->getDoctrine()->getManager();
        	$entityManager->persist($newOperation);
        	$entityManager->flush();

        	return $this->redirect($this->generateUrl('listOperation'));
        }

        return $this->render('operation/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/", methods={"POST"})
     */
    /*public function newApi(Request $request, SerializerInterface $serializer)
    {
        $json = $serializer->serialize(
            $operation,
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
     * @Route("/edit/{id}", requirements={"id"="\d+"}, methods={"GET","POST"}, name="editOperation")
     */
    public function edit($id, Request $request)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        // Variable qui contient le Repository
        $operationRepository = $display->getRepository(Operation::class);

        // Equivalent du SELECT * where id=(paramètre)
        $edit = $operationRepository->find($id);

        $form = $this->createForm(OperationType::class, $edit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST'))
        {
            $edit = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirect($this->generateUrl('listOperation'));
        }

        // ----------------------------------
        // On demande à la vue d'afficher la commande plus tous ses produits
        // ----------------------------------
        return $this->render('operation/edit.html.twig', ['form' => $form->createView()]); // On affecte notre tableau contenant la(les) valeur(s) de la variable à la vue
    }

    /**
     * @Route("/", requirements={"id"="\d+"}, methods={"POST"})
     */
    /*public function editApi($id, Request $request, SerializerInterface $serializer)
    {
        $json = $serializer->serialize(
            $operation,
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
     * @Route("/delete/{id}", requirements={"id"="\d+"}, methods={"GET","POST"}, name="deleteOperation")
     */
    public function delete($id)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        $operationRepository = $display->getRepository(Operation::class);

        $delete = $operationRepository->find($id);

        $display->remove($delete);

        $display->flush();

        return $this->redirect($this->generateUrl('listOperation'));
    }

    /**
     * @Route("/", requirements={"id"="\d+"}, methods={"GET","POST"})
     */
    /*public function deleteApi($id, SerializerInterface $serializer)
    {
        $json = $serializer->serialize(
            $operation,
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
     * @Route("/list", name="listOperation", methods={"GET"})
     */
    public function list()
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        // Variable qui contient le Repository
        $operationRepository = $display->getRepository(Operation::class);

        // Equivalent du SELECT *
        $list = $operationRepository->findAll();

        // ----------------------------------
        // On demande à la vue d'afficher la liste des commandes
        // ----------------------------------
        return $this->render('operation/list.html.twig', ['listOp' => $list]);
        // On affecte notre tableau contenant la(les) valeur(s) de la variable à la vue
    }
}

?>
