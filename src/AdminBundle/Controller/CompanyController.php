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
use App\AdminBundle\Entity\Contact;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        if ($this->isGranted('ROLE_COMMERCIAL') || $this->isGranted('ROLE_RESPONSABLE') || $this->isGranted('ROLE_DIRECTEUR')) {
            $new = new Company();

            $form = $this->createForm(CompanyType::class, $new);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $new = $form->getData();
                $companyPicture = $form['CompanyLogo']->getData();
                $file = $companyPicture;

                if ($file !== null) {
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
        else
        {
            return $this->redirect($this->generateUrl('index'));
        }
    }

    /**
     * @Route("/edit/{id}", name="editCompany", requirements={"id"="\d+"}, methods={"GET","POST"})
     */
    public function edit($id, Request $request)
    {
        if ($this->isGranted('ROLE_COMMERCIAL') || $this->isGranted('ROLE_RESPONSABLE') || $this->isGranted('ROLE_DIRECTEUR'))
        {
            // Appel de Doctrine
            $display = $this->getDoctrine()->getManager();

            // Variable qui contient le Repository
            $companyRepository = $display->getRepository(Company::class);

            // Equivalent du SELECT * where id=(paramètre)
            $edit = $companyRepository->find($id);

            // Appel de la fonction listContactOfCommercial() du repository de la classe Contact
            $contactRepository = $display->getRepository(Contact::class);
            $listContact = $contactRepository->listContactOfCompany($id);
            $nbContact = $contactRepository->countContactOfCompany($id);

            $form = $this->createForm(CompanyType::class, $edit);
            $form->add('CompanyStatus', CheckboxType::class, array('label' => 'Statut', 'required' => false));

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST')) {
                $edit = $form->getData();
                $companyPicture = $form['CompanyLogo']->getData();
                $file = $companyPicture;

                if ($file !== null)
                {
                    // On vérifie si le fichier est en base
                    if($edit->getContactPhoto() !== null)
                    {
                        // Variable qui contient l'ancien fichier
                        $oldFile = $this->getParameter('images_directory').'/'.
                            $edit->getCompanyLogo();

                        // On supprime l'ancien fichier en local
                        if (file_exists($oldFile)) {
                            unlink($oldFile);
                        }
                    }
                    $fileName = $file->getClientOriginalName();
                    // On envoit le fichier dans le dossier images
                    try {
                        $file->move($this->getParameter('images_directory'), $fileName);
                    } catch (FileException $e) {
                        // S'il y a un soucis pendant l'upload on catch
                    }

                    $edit->setCompanyLogo($fileName);
                }
                $entityManager = $this->getDoctrine()->getManager();

                $edit->setCompanyDateUpdate(new \DateTime());
                $entityManager->flush();

                return $this->redirectToRoute('listCompany');
            }

            return $this->render('company/edit.html.twig', array('form' => $form->createView(), 'company' => $edit, 'listContact' => $listContact, 'nbContact' => $nbContact));
        }
        else
        {
            return $this->redirect($this->generateUrl('index'));
        }
    }

    /**
     * @Route("/edit/potential/{id}", name="companyPotential", methods={"POST"})
     */
    public function changePotential(Request $request, Company $company)
    {
        if ($this->isGranted('ROLE_COMMERCIAL') || $this->isGranted('ROLE_RESPONSABLE') || $this->isGranted('ROLE_DIRECTEUR'))
        {
            $potential = (int)$request->request->get("potential_level");
            $company->setCompanyPotential($potential);
            $this->getDoctrine()->getManager()->flush();
            $data = array(
                "retour" => true
            );
            // $response = new Response(json_encode($data, 200));
            // $response->headers->set('Content-Type', 'application/json');
            return new JsonResponse($data);
        }
        else
        {
            return $this->redirect($this->generateUrl('index'));
        }
    }

    /**
     * @Route("/delete/{id}", name="deleteCompany", requirements={"id"="\d+"}, methods={"GET","POST"})
     */
    public function delete($id)
    {
        if ($this->isGranted('ROLE_COMMERCIAL') || $this->isGranted('ROLE_RESPONSABLE') || $this->isGranted('ROLE_DIRECTEUR')) {
            // Appel de Doctrine
            $display = $this->getDoctrine()->getManager();

            $companyRepository = $display->getRepository(Company::class);

            $delete = $companyRepository->find($id);

            $display->remove($delete);

            $display->flush();

            return $this->redirectToRoute('listCompany');
        }
        else
        {
            return $this->redirect($this->generateUrl('index'));
        }
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
            $contactRepository = $display->getRepository(Contact::class);

            // Equivalent du SELECT *
            $list = $companyRepository->findAll();


            $nbsContact = [];

            // Pour récupérer le nombre d'entreprise et contact géré par un commercial
            foreach ($list as $key => $value) {
                // La clé de l'array devient l'id du commercial
                $key = $value->getId();

                // Appel de la fonction countContact() du repository de la classe Contact
                $nbContact = $contactRepository->countContactOfCompany($value->getId());

                // Array $nbsContact
                $nbsContact += [$key => $nbContact[1]]; // Exemple $nbsContact = [2 => 48]
            }

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
            return $this->render('company/list.html.twig', array('lesEntreprises' => $list, 'nbContact' => $nbsContact, 'companyLink' => true)); // On affecte le tableau à la vue
        }
        else {
            return $this->redirect($this->generateUrl('index'));
        }


    }
}
