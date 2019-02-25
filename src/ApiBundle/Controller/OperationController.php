<?php

namespace App\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\AdminBundle\Entity\Operation;
use App\AdminBundle\Form\OperationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\VarDumper;

// Préfix url
//* @Groups({"Light"})
//* @MaxDepth(1)
/**
 * @Route("/operation")
 */
class OperationController extends AbstractController
{
    /**
     * @Route("/", methods={"POST"})
     */
    public function new(Request $request, SerializerInterface $serializer)
    {
        $new = new Operation();

    	$form = $this->createForm(OperationType::class, $new);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST'))
        {
        	$new = $form->getData();

        	$entityManager = $this->getDoctrine()->getManager();
        	$entityManager->persist($new);
        	$entityManager->flush();

            $json = $serializer->serialize(
                $new,
                'json',
                ['groups'=>["Light"]]
            );

            $response = new Response();
            $response->setContent($json);
            $response->headers->set('Content-type', 'application/JSON');

            return $response;
        }
    }

    /**
     * @Route("/edit/{id}", requirements={"id"="\d+"}, methods={"POST"})
     */
    public function edit($id, Request $request, SerializerInterface $serializer)
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

            $json = $serializer->serialize(
                $edit,
                'json',
                ['groups'=>["Light"]]
            );

            $response = new Response();
            $response->setContent($json);
            $response->headers->set('Content-type', 'application/JSON');

            return $response;
        }
    }

    /**
     * @Route("/delete/{id}", requirements={"id"="\d+"}, methods={"DELETE"})
     */
    public function delete($id, SerializerInterface $serializer)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        $operationRepository = $display->getRepository(Operation::class);

        $delete = $operationRepository->find($id);

        $display->remove($delete);

        $display->flush();

        $json = $serializer->serialize(
            $delete,
            'json',
            ['groups'=>["Light"]]
        );

        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-type', 'application/JSON');

        return $response;
    }

    /**
     * @Route("/", methods={"GET"})
     */
    public function list(Request $request, SerializerInterface $serializer)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        // Variable qui contient le Repository
        $operationRepository = $display->getRepository(Operation::class);

        // Equivalent du SELECT *
        $list = $operationRepository->findAll();

        if ($request->isXmlHttpRequest()) {
            $json = $serializer->serialize(
                $list,
                'json',
                ['groups'=>["Light"]]
            );

            $response = new Response();
            $response->setContent($json);
            $response->headers->set('Content-type', 'application/JSON');

            return $response;
        }
    }
}
