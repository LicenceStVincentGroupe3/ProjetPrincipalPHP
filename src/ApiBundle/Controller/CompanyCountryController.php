<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\AdminBundle\Entity\CompanyCountry;
use App\AdminBundle\AdminBundle\Form\CompanyCountryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

// Préfix url
//* @Groups({"Light"})
//* @MaxDepth(1)
/**
 * @Route("/company/country")
 */
class CompanyCountryController extends AbstractController
{
    /**
     * @Route("/", methods={"POST"})
     */
    public function new(Request $request, SerializerInterface $serializer)
    {
        $new = new CompanyCountry();

        $form = $this->createForm(CompanyCountryType::class, $new);
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
        }

        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-type', 'application/JSON');

        return $response;
    }

    /**
     * @Route("/", requirements={"id"="\d+"}, methods={"POST"})
     */
    public function edit($id, Request $request, SerializerInterface $serializer)
    {
        $display = $this->getDoctrine()->getManager();

        $companyCountryRepository = $display->getRepository(CompanyCountry::class);

        $edit = $companyCountryRepository->find($id);

        $form = $this->createForm(CompanyCountryType::class, $edit);
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
        }

        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-type', 'application/JSON');

        return $response;
    }

    /**
     * @Route("/", requirements={"id"="\d+"}, methods={"GET","POST"})
     */
    public function delete($id, SerializerInterface $serializer)
    {
        $display = $this->getDoctrine()->getManager();

        $companyCountryRepository = $display->getRepository(CompanyCountry::class);

        $delete = $companyCountryRepository->find($id);

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
     * @Route("/list", name="listCountry", methods={"GET"})
     */
    public function list(Request $request, SerializerInterface $serializer)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        // Variable qui contient le Repository
        $companyCountryRepository = $display->getRepository(CompanyCountry::class);

        // Equivalent du SELECT *
        $list = $companyCountryRepository->findAll();

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
