<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\CompanyBusinessCategory;
use App\AdminBundle\Form\CompanyBusinessCategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

// Préfix url
//* @Groups({"Light"})
//* @MaxDepth(1)
/**
 * @Route("/company/business/category")
 */
class CompanyBusinessCategoryController extends AbstractController
{
    /**
     * @Route("/", methods={"POST"})
     */
    public function new(Request $request, SerializerInterface $serializer)
    {
        $new = new CompanyBusinessCategory();

        $form = $this->createForm(CompanyBusinessCategoryType::class, $new);
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
     * @Route("/edit/id", requirements={"id"="\d+"}, methods={"POST"})
     */
    public function edit($id, Request $request, SerializerInterface $serializer)
    {
        $display = $this->getDoctrine()->getManager();

        $companyBusinessCategoryRepository = $display->getRepository(CompanyBusinessCategory::class);

        $edit = $companyBusinessCategoryRepository->find($id);

        $form = $this->createForm(CompanyBusinessCategoryType::class, $edit);
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
     * @Route("/delete/id", requirements={"id"="\d+"}, methods={"DELETE"})
     */
    public function delete($id, SerializerInterface $serializer)
    {
        $display = $this->getDoctrine()->getManager();

        $companyBusinessCategoryRepository = $display->getRepository(CompanyBusinessCategory::class);

        $delete = $companyBusinessCategoryRepository->find($id);

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
        $companyBusinessCategoryRepository = $display->getRepository(CompanyBusinessCategory::class);

        // Equivalent du SELECT *
        $list = $companyBusinessCategoryRepository->findAll();

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
