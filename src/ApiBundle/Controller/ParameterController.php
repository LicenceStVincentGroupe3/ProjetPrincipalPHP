<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\Parameter;
use App\AdminBundle\Form\ParameterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Annotation\Groups;

// Préfix url
//* @Groups({"Light"})
//* @MaxDepth(1)
/**
 * @Route("/parameter")
 */
class ParameterController extends AbstractController
{
    /* ---------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    */

    /**
     * @Route("/", methods={"POST"})
     */
    public function new(Request $request, SerializerInterface $serializer)
    {
    	$newParameter = new Parameter();
					
    	$form = $this->createForm(ParameterType::class, $newParameter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST'))
        {
            $newParameter = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newParameter);
            $entityManager->flush();        

            $json = $serializer->serialize(
            $newParameter,
            'json',
            ['groups'=>["Light"]]
        );

        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-type', 'application/JSON');

        return $response;
        }
    }   

    /* ---------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    */

    /**
     * @Route("/edit/id", requirements={"id"="\d+"}, methods={"PUT"})
     */
    public function edit($id, Request $request, SerializerInterface $serializer)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        // Variable qui contient le Repository
        $parameterRepository = $display->getRepository(Parameter::class);

        // Equivalent du SELECT * where id=(paramètre)
        $edit = $parameterRepository->find($id);

        $form = $this->createForm(ParameterType::class, $edit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('PUT'))
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

    /* ---------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    */

    /**
     * @Route("/delete/id", requirements={"id"="\d+"}, methods={"DELETE"})
     */
    public function delete($id, SerializerInterface $serializer)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        $parameterRepository = $display->getRepository(Parameter::class);

        $delete = $parameterRepository->find($id);

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

    /* ---------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    */

    /**
     * @Route("/", methods={"GET"})
     */
    public function list(Request $request, SerializerInterface $serializer)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        // Variable qui contient le Repository
        $parameterRepository = $display->getRepository(Parameter::class);

        // Equivalent du SELECT *
        $list = $parameterRepository->findAll();

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

?>
