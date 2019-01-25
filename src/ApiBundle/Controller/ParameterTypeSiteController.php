<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\ParameterTypeSite;
use App\AdminBundle\Form\ParameterTypeSiteType;
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
 * @Route("/parameterTypeSite")
 */
class ParameterTypeSiteController extends AbstractController
{
    /**
     * @Route("/", methods={"POST"})
     */
    public function new(Request $request, SerializerInterface $serializer)
    {
    	$parameterTypeSite = new ParameterTypeSite();

    	$form = $this->createForm(ParameterTypeSiteType::class, $parameterTypeSite);

        // La méthode handleRequest de la class form permet de récupérer les valeurs des champs dans les imputs du formulaire //
        $form->handleRequest($request);
 	
    	if($form->isSubmitted() && $form->isValid())
        {
            $parameterTypeSite = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($parameterTypeSite);
            $entityManager->flush();        

            $json = $serializer->serialize(
            $parameterTypeSite,
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
        $repository = $this->getDoctrine()->getManager()->getRepository(ParameterTypeSite::class);

        $editParameterTypeSite = $repository->find($id);

        // Equivalent du SELECT * where id=(paramètre) //
        $form = $this->createForm(ParameterTypeSiteType::class, $editParameterTypeSite);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() && $request->isMethod('POST'))
        {
            $editParameterTypeSite = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();        

            $json = $serializer->serialize(
            $editParameterTypeSite,
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
    {
        $suppBD = $this->getDoctrine()->getManager();
        // On créer un objet instance de contact
        $suppParameterTypeSite = $suppBD->getRepository(ParameterTypeSite::class)->find($id);
        // Suppression du contact
        $suppBD->remove($suppParameterTypeSite);
        // Execution
        $display->flush();        
        $json = $serializer->serialize(
            $suppParameterTypeSite,
            'json',
            ['groups'=>["Light"]]
        );

        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-type', 'application/JSON');

        return $response;
    }   

    /**
     * @Route("/", name="listParameterTypeSite", methods={"GET"})
     */
    public function list(Request $request, SerializerInterface $serializer)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();
        // récup de la liste des contacts
        //$repository = $this->getDoctrine()->getManager()->getRepository(ParameterTypeSite::class);
        $repository = $display->getRepository(ParameterTypeSite::class);

        $listParameterTypeSite = $repository->findAll();

        if ($request->isXmlHttpRequest()) {
            $json = $serializer->serialize(
                $listParameterTypeSite,
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
