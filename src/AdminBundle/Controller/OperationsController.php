<?php

namespace App\AdminBundle\Controller;

use Faker;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\AdminBundle\Entity\Operations;
use App\AdminBundle\Form\OperationsType;
use App\AdminBundle\Entity\OperationSettings;
use App\AdminBundle\Entity\OperationForm;
use App\AdminBundle\Form\OperationSettingsType;
use Symfony\Component\Routing\Annotation\Route;
use App\AdminBundle\Form\OperationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// Préfix url
/**
 * @Route("/operations")
 */
class OperationsController extends AbstractController
{
    /**
     * @Route("/new", name="newOperation", methods={"GET","POST"})
     */
    function new(Request $request): Response
    {
        if ($this->isGranted('ROLE_COMMERCIAL')) {
            // Appel de Doctrine
            $display = $this->getDoctrine()->getManager();

            $operationsRepository = $display->getRepository(Operations::class);

            $new = new Operations();

            $form = $this->createForm(OperationsType::class, $new);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $data = $request->request->get("operation");

                $new->setOperationCreated(new \DateTime());
                $new->setOperationSent(false);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($new);
                $entityManager->flush();

                return $this->redirectToRoute('listOperation');
            }

            return $this->render('operations/new.html.twig', [
                'operation' => $new,
                'form' => $form->createView(),
                'opeCode' => Faker\Factory::create('fr_FR'),
                'operationLink' => true
            ]);
        }
        else {
            return $this->redirect($this->generateUrl('login'));
        }
    }

    /**
     * @Route("/edit/{operationCode}", name="editOperation", methods={"GET","POST"})
     */
    public function edit(Request $request, Operations $operation): Response
    {
        if ($this->isGranted('ROLE_COMMERCIAL')) {

            // Onglet formulaire
            if ($operation->getOperationForm() != null) {
                $operationForm = $this->getDoctrine()
                    ->getRepository(OperationForm::class)
                    ->findOneBy(array("id" => $operation->getOperationForm()->getId()));
            } 
            else {
                $operationForm = new OperationForm();
            }

            $formType = $this->createForm(OperationFormType::class);
            $formType->handleRequest($request);

            if ($formType->isSubmitted() && $formType->isValid()) {
                $operationForm->setOperations($operation);
                $operation->setOperationForm($operationForm);
                $tableCheckbox = $request->get("operation_form");

                if (array_key_exists("contactsSexe", $tableCheckbox)) {
                    $operationForm->setContactsSexe(count($tableCheckbox["contactsSexe"]));
                } else {
                    $operationForm->setContactsSexe(0);
                }
                if (array_key_exists("contactsFirstname", $tableCheckbox)) {
                    $operationForm->setContactsFirstname(count($tableCheckbox["contactsFirstname"]));
                } else {
                    $operationForm->setContactsFirstname(0);
                }
                if (array_key_exists("contactsName", $tableCheckbox)) {
                    $operationForm->setContactsName(count($tableCheckbox["contactsName"]));
                } else {
                    $operationForm->setContactsName(0);
                }
                if (array_key_exists("contactsBirthday", $tableCheckbox)) {
                    $operationForm->setContactsBirthday(count($tableCheckbox["contactsBirthday"]));
                } else {
                    $operationForm->setContactsBirthday(0);
                }
                if (array_key_exists("contactsMailPro", $tableCheckbox)) {
                    $operationForm->setContactsMailPro(count($tableCheckbox["contactsMailPro"]));
                } else {
                    $operationForm->setContactsMailPro(0);
                }
                if (array_key_exists("contactsMobilePhone", $tableCheckbox)) {
                    $operationForm->setContactsMobilePhone(count($tableCheckbox["contactsMobilePhone"]));
                } else {
                    $operationForm->setContactsMobilePhone(0);
                }
                if (array_key_exists("contactsPhone", $tableCheckbox)) {
                    $operationForm->setContactsPhone(count($tableCheckbox["contactsPhone"]));
                } else {
                    $operationForm->setContactsPhone(0);
                }
                if (array_key_exists("contactsLinkedinAddress", $tableCheckbox)) {
                    $operationForm->setContactsLinkedinAddress(count($tableCheckbox["contactsLinkedinAddress"]));
                } else {
                    $operationForm->setContactsLinkedinAddress(0);
                }
                if (array_key_exists("contacts_twitter", $tableCheckbox)) {
                    $operationForm->setContactsTwitterAddress(count($tableCheckbox["contactsTwitterAddress"]));
                } else {
                    $operationForm->setContactsTwitterAddress(0);
                }
                if (array_key_exists("contacts_facebook", $tableCheckbox)) {
                    $operationForm->setContactsFacebookAddress(count($tableCheckbox["contactsFacebookAddress"]));
                } else {
                    $operationForm->setContactsFacebookAddress(0);
                }
                if (array_key_exists("contactsJob", $tableCheckbox)) {
                    $operationForm->setContactsJob(count($tableCheckbox["contactsJob"]));
                } else {
                    $operationForm->setContactsJob(0);
                }
                if (array_key_exists("contactsWorkName", $tableCheckbox)) {
                    $operationForm->setContactsPoste(count($tableCheckbox["contactsWorkName"]));
                } else {
                    $operationForm->setContactsPoste(0);
                }
                if (array_key_exists("companyName", $tableCheckbox)) {
                    $operationForm->setCompanyName(count($tableCheckbox["companyName"]));
                } else {
                    $operationForm->setCompanyName(0);
                }
                if (array_key_exists("companyNaf", $tableCheckbox)) {
                    $operationForm->setCompanyNaf(count($tableCheckbox["companyNaf"]));
                } else {
                    $operationForm->setCompanyNaf(0);
                }
                if (array_key_exists("companyLegalStatus", $tableCheckbox)) {
                    $operationForm->setCompanyLegalStatus(count($tableCheckbox["companyLegalStatus"]));
                } else {
                    $operationForm->setCompanyLegalStatus(0);
                }
                if (array_key_exists("companySiret", $tableCheckbox)) {
                    $operationForm->setCompanySiret(count($tableCheckbox["companySiret"]));
                } else {
                    $operationForm->setCompanySiret(0);
                }
                if (array_key_exists("companyNbEmployees", $tableCheckbox)) {
                    $operationForm->setCompanyNbEmployees(count($tableCheckbox["companyNbEmployees"]));
                } else {
                    $operationForm->setCompanyNbEmployees(0);
                }
                if (array_key_exists("companyTurnovers", $tableCheckbox)) {
                    $operationForm->setCompanyTurnovers(count($tableCheckbox["companyTurnovers"]));
                } else {
                    $operationForm->setCompanyTurnovers(0);
                }
                if (array_key_exists("companyAddress", $tableCheckbox)) {
                    $operationForm->setCompanyAddress(count($tableCheckbox["companyAddress"]));
                } else {
                    $operationForm->setCompanyAddress(0);
                }
                if (array_key_exists("companyPostalCode", $tableCheckbox)) {
                    $operationForm->setCompanyPostalCode(count($tableCheckbox["companyPostalCode"]));
                } else {
                    $operationForm->setCompanyPostalCode(0);
                }
                if (array_key_exists("companyCountry", $tableCheckbox)) {
                    $operationForm->setCompanyCountry(count($tableCheckbox["companyCountry"]));
                } else {
                    $operationForm->setCompanyCountry(0);
                }
                if (array_key_exists("companyStandardPhone", $tableCheckbox)) {
                    $operationForm->setCompanyStandardPhone(count($tableCheckbox["companyStandardPhone"]));
                } else {
                    $operationForm->setCompanyStandardPhone(0);
                }
                if (array_key_exists("companyFax", $tableCheckbox)) {
                    $operationForm->setCompanyFax(count($tableCheckbox["companyFax"]));
                } else {
                    $operationForm->setCompanyFax(0);
                }
                if (array_key_exists("companyWebsite", $tableCheckbox)) {
                    $operationForm->setCompanyWebsite(count($tableCheckbox["companyWebsite"]));
                } else {
                    $operationForm->setCompanyWebsite(0);
                }
                if (array_key_exists("companyEmail", $tableCheckbox)) {
                    $operationForm->setCompanyEmail(count($tableCheckbox["companyEmail"]));
                } else {
                    $operationForm->setCompanyEmail(0);
                }
                $this->getDoctrine()->getManager()->persist($operationForm);
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('editOperation', [
                    'operationCode' => $operation->getOperationCode(),
                ]);
            }


            // Onglet Informations
            $form = $this->createForm(OperationsType::class, $operation);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $operation->setCommercialLastUpdate($this->getUser());
                $operation->setOperationUpdated(new \DateTime());

                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('editOperation', [
                    'operationCode' => $operation->getOperationCode(),
                ]);
            }


            // Onglet Paramètres
            if ($operation->getOperationSettings() != null) {
                $operationSettings = $operation->getOperationSettings();
            } 
            else {
                $operationSettings = new OperationSettings();
            }

            $operationSettingsForm = $this->createForm(OperationSettingsType::class, $operationSettings);

            $operationSettingsForm->handleRequest($request);

            if ($operationSettingsForm->isSubmitted() && $operationSettingsForm->isValid()) {
                $operation->setOperationSettings($operationSettings);
                $operation->setCommercialLastUpdate($this->getUser());
                $operationSettings->setOperationSettingsCode($operation);

                $operationSettingsEmailVisual = $operationSettingsForm['operationSettingsEmailVisual']->getData();
                $operationSettingsVisualPage = $operationSettingsForm['operationSettingsVisualPage']->getData();

                $emailVisualFile = $operationSettingsEmailVisual;
                $visualPageFile = $operationSettingsVisualPage;

                if ($emailVisualFile !== null)
                {
                    $fileName = $emailVisualFile->getClientOriginalName();
                    $newFileName = 'visual_email_'.$operation->getOperationCode().'_'.$fileName;

                    // On envoit le fichier dans le dossier images
                    try {
                        $emailVisualFile->move($this->getParameter('images_directory'), $newFileName);
                    } catch (FileException $e) {
                        // S'il y a un soucis pendant l'upload on catch
                    }

                    $operationSettings->setOperationSettingsEmailVisual($newFileName);
                }

                if ($visualPageFile !== null)
                {
                    $fileName = $visualPageFile->getClientOriginalName();
                    $newFileName = 'visual_page_'.$operation->getOperationCode().'_'.$fileName;

                    // On envoit le fichier dans le dossier images
                    try {
                        $visualPageFile->move($this->getParameter('images_directory'), $newFileName);
                    } catch (FileException $e) {
                        // S'il y a un soucis pendant l'upload on catch
                    }

                    $operationSettings->setOperationSettingsVisualPage($newFileName);
                }

                $this->getDoctrine()->getManager()->persist($operationSettings);
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('editOperation', [
                    'operationCode' => $operation->getOperationCode(),
                ]);
            }

            return $this->render('operations/edit.html.twig', [
                'operation' => $operation,
                "operationForm" => $operationForm,
                "operationSettings" => $operationSettings,
                'form' => $form->createView(),
                "formType" => $formType->createView(),
                "operationSettingsForm" => $operationSettingsForm->createView(),
                'operationLink' => true
            ]);
        }

        else {

            return $this->redirect($this->generateUrl('login'));

        }
    }

    /**
     * @Route("/delete/{operationCode}", name="deleteOperation", methods={"GET","POST"})
     */
    public function delete($operationCode)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();
        $operationsRepository = $display->getRepository(Operations::class);

        $operationsRepository->activeArchive([$operationCode]);

        return $this->redirectToRoute('listOperation');
    }

    /**
     * @Route("/list", name="listOperation", methods={"GET","POST"})
     */
    public function list(Request $httpRequest): Response
    {
        if ($this->isGranted('ROLE_COMMERCIAL')) {
            // Appel de Doctrine
            $display = $this->getDoctrine()->getManager();

            // Variable qui contient le Repository
            $operationsRepository = $display->getRepository(Operations::class);

            // Si c'est le Directeur
            if ($this->isGranted('ROLE_DIRECTEUR')) {
                // Equivalent du SELECT *
                $listOperations = $operationsRepository->findBy(['archived' => false]);
            }
            // Sinon
            else {
                // Equivalent du SELECT xxx FROM xxx::class WHERE xxx
                $listOperations = $operationsRepository->listOperationsOfUser($this->getUser()->getId());
            }

            // Dans le cas d'une suppression d'un(ou plusieurs) commercial(commerciaux)
            if ($httpRequest->isMethod('POST'))
            {
                // Appel de Doctrine
                $display = $this->getDoctrine()->getManager();
                $operationsRepository = $display->getRepository(Operations::class);
                // Contient les name des <input>
                $formData = Request::createFromGlobals();
                // On récupère le name de la checkbox
                $listData = $formData->request->get('deleteData');
                // Si l'utilisateur a coché une checkbox
                if ($listData != null) {
                    // Appel de la fonction activeArchive()
                    $operationsRepository->activeArchive($listData);
                }
                return $this->redirect($this->generateUrl('listOperation'));
            }

            return $this->render('operations/list.html.twig', [
                'listOp' => $listOperations, 'operationLink' => true]);
        }
        else {
            return $this->redirect($this->generateUrl('login'));
        }
    }
}
