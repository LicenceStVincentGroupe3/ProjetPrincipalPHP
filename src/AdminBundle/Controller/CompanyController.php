<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\Company;
use App\AdminBundle\Form\CompanyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

// Préfix url
/**
 * @Route("/company")
 */
class CompanyController extends AbstractController
{
    /**
     * @Route("/new", methods={"GET","POST"}, name="newCompany")
     */
    public function new(Request $request)
    {
        $new = new Company();

        $form = $this->createForm(CompanyType::class, $new);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $new = $form->getData();
            $companyPicture = $form['CompanyLogo']->getData();
            $file = $companyPicture;

            if ($file !== null)
            {
                $fileName = $file->getClientOriginalName();

                // On envoit le fichier dans le dossier images
                try {
                    $file->move($this->getParameter('images_directory'), $fileName);
                } catch (FileException $e) {
                    // S'il y a un soucis pendant l'upload on catch
                }

                $new->setCompanyLogo($fileName);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($new);
            $entityManager->flush();

            return $this->redirectToRoute('listCompany');
        }
        return $this->render('company/new.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/edit/{id}", name="editCompany", requirements={"id"="\d+"}, methods={"GET","POST"})
     */
    public function edit($id, Request $request)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        // Variable qui contient le Repository
        $companyRepository = $display->getRepository(Company::class);

        // Equivalent du SELECT * where id=(paramètre)
        $edit = $companyRepository->find($id);

        $form = $this->createForm(CompanyType::class, $edit);
        $form->add('CompanyPotential', IntegerType::class, array('label' => 'Potentiel', 'required' => false))
        ->add('CompanyStatus', CheckboxType::class, array('label' => 'Statut', 'required' => false));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST')) 
        {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirectToRoute('listCompany');
        }

        return $this->render('company/edit.html.twig', array(
        'form' => $form->createView(),'company' => $edit
        ));
    }

    /**
     * @Route("/delete/{id}", name="deleteCompany", requirements={"id"="\d+"}, methods={"GET","POST"})
     */
    public function delete($id)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        $companyRepository = $display->getRepository(Company::class);

        $delete = $companyRepository->find($id);

        $display->remove($delete);

        $display->flush();

        return $this->redirectToRoute('listCompany');
    }

    /**
     * @Route("/list", name="listCompany", methods={"GET", "POST"})
     */
    public function list(Request $httpRequest)
    {
        if ($this->isGranted('ROLE_COMMERCIAL') || $this->isGranted('ROLE_RESPONSABLE') || $this->isGranted('ROLE_DIRECTEUR'))
        {
            // Appel de Doctrine
            $display = $this->getDoctrine()->getManager();

            // Variable qui contient le Repository
            $companyRepository = $display->getRepository(Company::class);

            // Equivalent du SELECT *
            $list = $companyRepository->findAll();

            // -------------------------------------------------------------
            // On demande à la vue d'afficher la liste des entreprises
            // -------------------------------------------------------------

            // Dans le cas d'une suppression d'un(ou plusieurs) commercial(commerciaux)
            if ($httpRequest->isMethod('POST'))
            {
                // Appel de Doctrine
                $display = $this->getDoctrine()->getManager();

                $companyRepository = $display->getRepository(Company::class);

                // Contient les name des <input>
                $formData = Request::createFromGlobals();

                // On récupère le name de la checkbox
                $listData = $formData->request->get('deleteData');

                // Si l'utilisateur a coché une checkbox
                if ($listData != null) {
                    // Appel de la fonction deleteCommercial()
                    $companyRepository->deleteCompany($listData);
                }

                return $this->redirect($this->generateUrl('listCompany'));
            }
            return $this->render('company/list.html.twig', array('lesEntreprises' => $list, 'companyLink' => true)); // On affecte le tableau à la vue
        }
        else {
            return $this->redirect($this->generateUrl('index'));
        }


    }
}
