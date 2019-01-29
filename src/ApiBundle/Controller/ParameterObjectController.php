<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\ParameterObject;
use App\AdminBundle\Form\ParameterObjectType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Annotation\Groups;

// Préfix url
//* @Groups({"Light"})
//* @MaxDepth(1)
/**
 * @Route("/parameterObject")
 */
class ParameterObjectController extends AbstractController
{
    /**
     * @Route("/", methods={"POST"})
     */
    public function new(Request $request, SerializerInterface $serializer)
    {
    	$parameterObject = new ParameterObject();

    	$form = $this->createForm(ParameterObjectType::class, $parameterObject);
        $form->handleRequest($request);
 	
    	if($form->isSubmitted() && $form->isValid())
        {
            $parameterObject = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($parameterObject);
            $entityManager->flush();        

            $json = $serializer->serialize(
            $parameterObject,
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
     * @Route("/edit/id", requirements={"id"="\d+"}, methods={"PUT"})
     */
    public function edit($id, Request $request, SerializerInterface $serializer)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(ParameterObject::class);

        $editParameterObject = $repository->find($id);

        // Equivalent du SELECT * where id=(paramètre) //
        $form = $this->createForm(ParameterObjectType::class, $editParameterObject);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() && $request->isMethod('PUT'))
        {
            $editParameterObject = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();        

            $json = $serializer->serialize(
            $editParameterObject,
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
     * @Route("/delete/id", requirements={"id"="\d+"}, methods={"DELETE"})
     */
    public function delete($id, SerializerInterface $serializer)
    {
        $suppBD = $this->getDoctrine()->getManager();
        // On créer un objet instance de contact
        $suppParameterObject = $suppBD->getRepository(ParameterObject::class)->find($id);
        // Suppression du contact
        $suppBD->remove($suppParameterObject);
        // Execution
        $display->flush();        
        $json = $serializer->serialize(
            $suppParameterObject,
            'json',
            ['groups'=>["Light"]]
        );

        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-type', 'application/JSON');

        return $response;
    } 


    /**
     * @Route("/", name="listParameterObject", methods={"GET"})
     */
    public function list(Request $request, SerializerInterface $serializer)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();
        // récup de la liste des contacts
        //$repository = $this->getDoctrine()->getManager()->getRepository(ParameterObject::class);
        $repository = $display->getRepository(ParameterObject::class);

        $listParameterObject = $repository->findAll();

        if ($request->isXmlHttpRequest()) {
            $json = $serializer->serialize(
                $listParameterObject,
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
