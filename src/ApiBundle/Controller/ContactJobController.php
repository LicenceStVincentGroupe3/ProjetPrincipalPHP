<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\ContactJob;
use App\AdminBundle\Form\ContactJobType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\VarDumper\VarDumper;

/**
 * @Route("/contactJob")
 */
class ContactJobController extends AbstractController
{
    /**
     * @Route("/", methods={"POST"})
     */
    public function new(Request $request)
    {
    	$contactJob = new ContactJob();

    	$form = $this->createForm(ContactJobType::class, $contactJob);

        // La méthode handleRequest de la class form permet de récupérer les valeurs des champs dans les imputs du formulaire //
        $form->handleRequest($request);
 	
    	if($form->isSubmitted() && $form->isValid())
        {
            $contactJob=$form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            // Persist prépare l'entité "contactJob" pour la création //
            $entityManager->persist($contactJob);
            // Flush envoie les infos en base (ajout) //
            $entityManager->flush();

            $json = $serializer->serialize(
                'json',
                ['groups'=>["Light"]]);

            $response = new Response();
            $response->setContent($json);
            $response->headers->set('Content-type', 'application/JSON');

            return $response;
    	}
    }



    /**
     * @Route("/edit/{id}", requirements={"id"="\d+"}, methods={"PUT"})
     */
    public function edit($id, Request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(ContactJob::class);

        $editContactJob = $repository->find($id);

        // Equivalent du SELECT * where id=(paramètre) //
        $form = $this->createForm(ContactJobType::class, $editContactJob);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() && $request->isMethod('POST'))
        {
            $editContactJob = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            $json = $serializer->serialize(
                $editContactJob,
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
    public function delete($id)
    {
        $suppBD = $this->getDoctrine()->getManager();
        // On créer un objet instance de contact
        $suppContactJob = $suppBD->getRepository(ContactJob::class)->find($id);
        // Suppression du contact
        $suppBD->remove($suppContactJob);
        // Execution
        $suppBD->flush();

        $json = $serializer->serialize(
            $suppContactJob,
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
    public function list()
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();
        // récup de la liste des contacts
        //$repository = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        $repository = $display->getRepository(ContactJob::class);

        $listContactJob = $repository->findAll();
        // --------------------------
        // on demande à la vue d'afficher la liste des contacts
        // --------------------------
        $json = $serializer->serialize(
            $listContactJob,
            'json',
            ['groups'=>["Light"]]
        );

        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-type', 'application/JSON');

        return $response;
    }           
}
