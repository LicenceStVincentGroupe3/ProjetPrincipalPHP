<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\CompanyLegalStatus;
use App\AdminBundle\Form\CompanyLegalStatusType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * @Route("/company/legalStatus")
 */
class CompanyLegalStatusController extends AbstractController
{
    /**
     * @Route("/", methods={"POST"})
     */
    public function new(Request $request, SerializerInterface $serializer)
    {
        $newLegalStatus = new CompanyLegalStatus();
        $form = $this->createForm(CompanyLegalStatusType::class, $newLegalStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $newLegalStatus = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newLegalStatus);
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
    public function edit($id, Request $request, SerializerInterface $serializer)
    {
        $editLegalStatus = $this->getDoctrine()->getManager()->getRepository(CompanyLegalStatus::class)->find($id);

        $form = $this->createForm(CompanyLegalStatusType::class, $editLegalStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('PUT'))
        {
            $editLegalStatus = $form->getData();

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
        $suppBD = $this->getDoctrine()->getManager();

        // On crée un objet, instance de CompanyLegalStatus
        $suppBusinessCategory = new CompanyLegalStatus();

        $suppLegalStatus = $suppBD->getRepository(CompanyLegalStatus::class)->find($id);

        // Suppression du statut légal
        $suppBD->remove($suppBusinessCategory);

        // Exécution
        $suppBD->flush();

        $json = $serializer->serialize(
            $suppLegalStatus,
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
    public function list(SerializerInterface $serializer)
    {
        // ---------------------------------------
        // Récupération de la liste des status
        // ---------------------------------------
        $repository = $this->getDoctrine()->getManager()->getRepository(CompanyLegalStatus::class);

        $listLegalStatus = $repository->findAll();
        // -------------------------------------------------------------
        // On demande à la vue d'afficher la liste des status
        // -------------------------------------------------------------
        $json = $serializer->serialize(
            $listLegalStatus,
            'json',
            ['groups'=>["Light"]]
        );

        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-type', 'application/JSON');

        return $response;
    }
}
