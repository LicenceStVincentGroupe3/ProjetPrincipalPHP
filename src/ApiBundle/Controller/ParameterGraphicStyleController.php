<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\ParameterGraphicStyle;
use App\AdminBundle\Form\ParameterGraphicStyleType;
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
 * @Route("/parameterGraphicStyle")
 */
class ParameterGraphicStyleController extends AbstractController
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
    	$newParameterGraphicStyle = new ParameterGraphicStyle();
					
    	$form = $this->createForm(ParameterGraphicStyleType::class, $newParameterGraphicStyle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST'))
        {
            $newParameterGraphicStyle = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newParameterGraphicStyle);
            $entityManager->flush();        

            $json = $serializer->serialize(
            $newParameterGraphicStyle,
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
        $parameterGraphicStyleRepository = $display->getRepository(ParameterGraphicStyle::class);

        // Equivalent du SELECT * where id=(paramètre)
        $edit = $parameterGraphicStyleRepository->find($id);

        $form = $this->createForm(ParameterGraphicStyleType::class, $edit);
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

        $parameterGraphicStyleRepository = $display->getRepository(ParameterGraphicStyle::class);

        $delete = $parameterGraphicStyleRepository->find($id);

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
     * @Route("/", name="listParameterGraphicStyle", methods={"GET"})
     */
    public function list(Request $request, SerializerInterface $serializer)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        // Variable qui contient le Repository
        $parameterGraphicStyleRepository = $display->getRepository(ParameterGraphicStyle::class);

        // Equivalent du SELECT *
        $list = $parameterGraphicStyleRepository->findAll();

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
