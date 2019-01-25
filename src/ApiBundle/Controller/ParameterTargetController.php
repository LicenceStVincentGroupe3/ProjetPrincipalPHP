<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\ParameterTarget;
use App\AdminBundle\Form\ParameterTargetType;
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
 * @Route("/parameterTarget")
 */
class ParameterTargetController extends AbstractController
{
    /**
     * @Route("/", methods={"POST"})
     */
    public function new(Request $request, SerializerInterface $serializer)
    {
    	$parameterTarget = new ParameterTarget();

    	$form = $this->createForm(ParameterTargetType::class, $parameterTarget);

        // La méthode handleRequest de la class form permet de récupérer les valeurs des champs dans les imputs du formulaire //
        $form->handleRequest($request);
 	
    	if($form->isSubmitted() && $form->isValid())
        {
            $parameterTarget = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($parameterTarget);
            $entityManager->flush();        

            $json = $serializer->serialize(
            $parameterTarget,
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
     * @Route("/", requirements={"id"="\d+"}, methods={"PUT"})
     */
    public function edit($id, Request $request, SerializerInterface $serializer)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(ParameterTarget::class);

        $editParameterTarget = $repository->find($id);

        // Equivalent du SELECT * where id=(paramètre) //
        $form = $this->createForm(ParameterTargetType::class, $editParameterTarget);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() && $request->isMethod('PUT'))
        {
            $editParameterTarget = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();        

            $json = $serializer->serialize(
            $editParameterTarget,
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
     * @Route("/", requirements={"id"="\d+"}, methods={"DELETE"})
     */
    public function delete($id, SerializerInterface $serializer)
    
        $suppBD = $this->getDoctrine()->getManager();
        // On créer un objet instance de contact
        $suppParameterTarget = $suppBD->getRepository(ParameterTarget::class)->find($id);
        // Suppression du contact
        $suppBD->remove($suppParameterTarget);
        // Execution
        $display->flush();        
        $json = $serializer->serialize(
            $suppParameterTarget,
            'json',
            ['groups'=>["Light"]]
        );

        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-type', 'application/JSON');

        return $response;
    } 

    /**
     * @Route("/", name="listParameterTarget", methods={"GET"})
     */
    public function list(Request $request, SerializerInterface $serializer)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();
        // récup de la liste des contacts
        //$repository = $this->getDoctrine()->getManager()->getRepository(ParameterTarget::class);
        $repository = $display->getRepository(ParameterTarget::class);

        $listParameterTarget = $repository->findAll();

        if ($request->isXmlHttpRequest()) {
            $json = $serializer->serialize(
                $listParameterTarget,
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
