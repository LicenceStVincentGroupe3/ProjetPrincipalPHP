<?php

namespace App\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\VarDumper;
use App\AdminBundle\Form\CommercialType;
use App\AdminBundle\Entity\Company;
use App\AdminBundle\Entity\Contact;
use App\AdminBundle\Entity\Commercial;
use App\AdminBundle\Entity\CompanyCountry;
use Symfony\Component\HttpFoundation\RequestStack;

// Préfix url
/**
 * @Route("/commercial")
 */
class CommercialController extends AbstractController
{
    /**
     * @Route("/new", methods={"GET","POST"}, name="newCommercial")
     */
    public function new(Request $httpRequest, UserPasswordEncoderInterface $passwordEncoder)
    {
        if ($this->isGranted('ROLE_COMMERCIAL')) {

            if ($this->isGranted('ROLE_RESPONSABLE')) {
                // Appel de Doctrine
                $display = $this->getDoctrine()->getManager();

                $new = new Commercial();

                // Variable qui contient le Repository
                $companyCountry = $display->getRepository(CompanyCountry::class);

                // Variable qui contient le Repository
                $commercial = $display->getRepository(Commercial::class);

                // Equivalent du SELECT *
                $listCountry = $companyCountry->findAll();

                $form = $this->createForm(CommercialType::class, $new);

                // Contient les name des <input>
                $formData = Request::createFromGlobals();

                // On récupère le name de la <select>
                $idCountrySelected = $formData->request->get('country');

                // Si c'est le Directeur
                if ($this->isGranted('ROLE_DIRECTEUR')) {
                    $form->add('commercialProfil', ChoiceType::class, [
                        'choices'  => [
                            'Directeur' => 'ROLE_DIRECTEUR',
                            'Responsable' => 'ROLE_RESPONSABLE',
                            'Commercial' => 'ROLE_COMMERCIAL'
                        ]
                    ]);

                    $listHierarchy = $commercial->listHierarchyDirAndResp('ROLE_DIRECTEUR','ROLE_RESPONSABLE');
                }
                // Sinon
                else {
                    $form->add('commercialProfil', ChoiceType::class, [
                        'choices'  => [
                            'Commercial' => 'ROLE_COMMERCIAL'
                        ]
                    ]);

                    $listHierarchy = $commercial->listHierarchyResp('ROLE_RESPONSABLE');
                }

                // On récupère le name de la <select>
                $idHierarchy = $formData->request->get('hierarchy');
                
                $form->handleRequest($httpRequest);


                if ($form->isSubmitted() && $form->isValid() && $httpRequest->isMethod('POST'))
                {
                    $new = $form->getData();

                    $password = $passwordEncoder->encodePassword($new, $new->getPlainPassword());
                    $role = $new->getCommercialProfil();

                    $commercialName = $form['commercialName']->getData();
                    $commercialFirstName = $form['commercialFirstname']->getData();
                    $commercialPhoto = $form['commercialPhoto']->getData();
                    
                    $file = $commercialPhoto;

                    if ($file !== null) 
                    {
                        $fileName = $file->getClientOriginalName();
                        $newFileName = $commercialName.'_'.$commercialFirstName.'_'.$fileName;

                        // On envoit le fichier dans le dossier images
                        try {
                            $file->move($this->getParameter('images_directory'), $newFileName);
                        } catch (FileException $e) {
                            // S'il y a un soucis pendant l'upload on catch
                        }

                        $new->setCommercialPhoto($newFileName);
                    }

                    // Si l'utilisateur n'a séléctioné aucune région
                    if ($idCountrySelected == "0")
                    {
                       $new->setIdCompanyCountry(null);
                    }
                    // Sinon
                    else
                    {
                        // On récupère la région séléctionnée
                        $companySelected = $companyCountry->find($idCountrySelected);

                        // On l'attribut au commercial
                        $new->setIdCompanyCountry($companySelected);
                    }

                    // Si l'utilisateur n'a séléctioné aucun responsable N+1
                    if ($idHierarchy == "0")
                    {
                       $new->setHierarchy(null);
                    }
                    // Sinon
                    else
                    {
                        $new->setHierarchy($idHierarchy);
                    }
 
                    $new->setPassword($password);
                    $new->addRole($role);

                    $display->persist($new);
                    $display->flush();
                    // ... do any other work - like sending them an email, etc
                    // maybe set a "flash" success message for the user
                    $this->addFlash('success', 'Votre compte à bien été enregistré.');
                    //return $this->redirectToRoute('login');

                    return $this->redirect($this->generateUrl('listCommercial'));
                }

                return $this->render('commercial/new.html.twig', ['form' => $form->createView(), 'listCountry' => $listCountry, 'listHierarchy' => $listHierarchy, 'commercialTeamLink' => true]);
            }
            
            else {
                return $this->redirect($this->generateUrl('index'));
            }
        }

        else {

            return $this->redirect($this->generateUrl('login'));
        }
    }

    /**
     * @Route("/edit/{id}", requirements={"id"="\d+"}, methods={"GET","POST"}, name="editCommercial")
     */
    public function edit($id, Request $httpRequest)
    {
        if ($this->isGranted('ROLE_COMMERCIAL')) {

            if ($this->isGranted('ROLE_RESPONSABLE')) {
                // Appel de Doctrine
                $display = $this->getDoctrine()->getManager();

                // Variable qui contient le Repository
                $commercialRepository = $display->getRepository(Commercial::class);

                // Variable qui contient le Repository
                $companyCountry = $display->getRepository(CompanyCountry::class);

                // Variable qui contient le Repository
                $commercial = $display->getRepository(Commercial::class);

                // Equivalent du SELECT * where id=(paramètre)
                $edit = $commercialRepository->find($id);

                // Equivalent du SELECT *
                $listCountry = $companyCountry->findAll();

                $form = $this->createForm(CommercialType::class, $edit);

                // Contient les name des <input>
                $formData = Request::createFromGlobals();

                // On récupère le name de la <select>
                $idCountrySelected = $formData->request->get('country'); 

                // Si c'est le Directeur
                if ($this->isGranted('ROLE_DIRECTEUR')) {
                    $form->add('commercialProfil', ChoiceType::class, [
                        'choices'  => [
                            'A définir' => null,
                            'Directeur' => 'ROLE_DIRECTEUR',
                            'Responsable' => 'ROLE_RESPONSABLE',
                            'Commercial' => 'ROLE_COMMERCIAL'
                        ]
                    ]);

                    $listHierarchy = $commercial->listHierarchyDirAndResp('ROLE_DIRECTEUR','ROLE_RESPONSABLE');
                }
                // Sinon
                else {
                    $form->add('commercialProfil', ChoiceType::class, [
                        'choices'  => [
                            'A définir' => null,
                            'Commercial' => 'ROLE_COMMERCIAL'
                        ]
                    ]);

                    $listHierarchy = $commercial->listHierarchyResp('ROLE_RESPONSABLE');
                }

                // On récupère le name de la <select>
                $idHierarchy = $formData->request->get('hierarchy');

                $responsableN1 = $commercial->hierarchyN1($edit->getHierarchy());

                $form->handleRequest($httpRequest);

                if ($form->isSubmitted() && $form->isValid() && $httpRequest->isMethod('POST'))
                {
                    $edit = $form->getData();

                    $role = $edit->getCommercialProfil();

                    $commercialName = $edit->getCommercialName();
                    $commercialFirstName = $edit->getCommercialFirstname();
                    $commercialPhoto = $form['commercialPhoto']->getData();

                    $file = $commercialPhoto;

                    $entityManager = $this->getDoctrine()->getManager();

                    if ($file !== null) 
                    {
                        // On vérifie si le fichier est en base
                        if($edit->getCommercialPhoto() !== null) 
                        {
                            // Variable qui contient l'ancien fichier
                            $oldFile = $this->getParameter('images_directory').'/'.
                              $edit->getCommercialPhoto();

                            // On supprime l'ancien fichier en local
                            if (file_exists($oldFile)) {
                                unlink($oldFile);
                            }
                        }

                        $fileName = $file->getClientOriginalName();
                        $newFileName = $commercialName.'_'.$commercialFirstName.'_'.$fileName;

                        // On envoit le fichier dans le dossier images
                        try {
                            $file->move($this->getParameter('images_directory'), $newFileName);
                        } catch (FileException $e) {
                            // S'il y a un soucis pendant l'upload on catch
                        }

                        $edit->setCommercialPhoto($newFileName);
                    }

                    // Si l'utilisateur n'a séléctioné aucune région
                    if ($idCountrySelected == "0")
                    {
                       $edit->setIdCompanyCountry(null);
                    }
                    // Sinon
                    else
                    {
                        // On récupère la région séléctionnée
                        $companySelected = $companyCountry->find($idCountrySelected);

                        // On l'attribut au commercial
                        $edit->setIdCompanyCountry($companySelected);
                    }

                    // Si l'utilisateur n'a séléctioné aucun responsable N+1
                    if ($idHierarchy == "0")
                    {
                       $edit->setHierarchy(null);
                    }
                    // Sinon
                    else
                    {
                        $edit->setHierarchy($idHierarchy);
                    }

                    $edit->setCommercialLastUpdate(new \DateTime());
                    $edit->addRole($role);

                    $entityManager->flush();

                    return $this->redirect($this->generateUrl('listCommercial'));
                }

                // ----------------------------------
                // On demande à la vue d'afficher la commande plus tous ses produits
                // ----------------------------------
                return $this->render('commercial/edit.html.twig', ['editCom' => $edit, 'form' => $form->createView(), 'listCountry' => $listCountry, 'listHierarchy' => $listHierarchy, 'responsableN1' => $responsableN1, 'commercialTeamLink' => true]);
            }

            else {
                return $this->redirect($this->generateUrl('index'));
            }
        }

        else {

            return $this->redirect($this->generateUrl('login'));
        }

    }

    /**
     * @Route("/delete/{id}", requirements={"id"="\d+"}, methods={"GET","POST"}, name="deleteCommercial")
     */
    public function delete($id, Request $request)
    {
        if ($this->isGranted('ROLE_COMMERCIAL')) {

            if ($this->isGranted('ROLE_DIRECTEUR')) {
                // Appel de Doctrine
                $display = $this->getDoctrine()->getManager();

                $commercialRepository = $display->getRepository(Commercial::class);

                $delete = $commercialRepository->find($id);

                $display->remove($delete);

                $display->flush();

                return $this->redirect($this->generateUrl('listCommercial'));
            }

            elseif ($this->isGranted('ROLE_RESPONSABLE')) {
                // Appel de Doctrine
                $display = $this->getDoctrine()->getManager();

                $commercialRepository = $display->getRepository(Commercial::class);

                $delete = $commercialRepository->find($id);

                $display->remove($delete);

                $display->flush();

                return $this->redirect($this->generateUrl('listCommercial'));
            }
            
            else {
                return $this->redirect($this->generateUrl('index'));
            }
        }

        else {

            return $this->redirect($this->generateUrl('login'));
        }
    }

    /**
     * @Route("/list", name="listCommercial", methods={"GET","POST"})
     */
    public function list(Request $httpRequest)
    {
        if ($this->isGranted('ROLE_COMMERCIAL')) {
            
            if ($this->isGranted('ROLE_RESPONSABLE')) {
                // Déclaration des variables
                $nbsCompany = [];
                $nbsContact = [];

                // Appel de Doctrine
                $display = $this->getDoctrine()->getManager();

                // Variable qui contient le Repository
                $commercialRepository = $display->getRepository(Commercial::class);
                $companyRepository = $display->getRepository(Company::class);
                $contactRepository = $display->getRepository(Contact::class);

                // Si c'est le Directeur
                if ($this->isGranted('ROLE_DIRECTEUR')) {
                    // Equivalent du SELECT *
                    $list = $commercialRepository->findAll();
                }
                // Sinon
                else {
                    // Equivalent du SELECT xxx FROM xxx::class WHERE xxx
                    $list = $commercialRepository->findBy(['commercialProfil' => 'ROLE_COMMERCIAL']);
                }

                // Pour récupérer le nombre d'entreprise et contact géré par un commercial
                foreach ($list as $key => $value) {
                    // La clé de l'array devient l'id du commercial
                    $key = $value->getId();

                    // Appel de la fonction countCompany() du repository de la classe Company
                    $nbCompany = $companyRepository->countCompany($value->getId());

                    // Appel de la fonction countContact() du repository de la classe Contact
                    $nbContact = $contactRepository->countContact($value->getId());

                    // Array $nbsCompany
                    $nbsCompany += [$key => $nbCompany[1]]; // Exemple $nbsCompany = [2 => 48]

                    // Array $nbsContact
                    $nbsContact += [$key => $nbContact[1]]; // Exemple $nbsContact = [2 => 48]
                }
                

                // Dans le cas d'une suppression d'un(ou plusieurs) commercial(commerciaux)
                if ($httpRequest->isMethod('POST'))
                {
                    // Appel de Doctrine
                    $display = $this->getDoctrine()->getManager();

                    $commercialRepository = $display->getRepository(Commercial::class);

                    // Contient les name des <input>
                    $formData = Request::createFromGlobals();

                    // On récupère le name de la checkbox
                    $listData = $formData->request->get('deleteData');

                    // Si l'utilisateur a coché une checkbox
                    if ($listData != null) {
                        // Appel de la fonction deleteCommercial()
                        $commercialRepository->deleteCommercial($listData);
                    }

                    return $this->redirect($this->generateUrl('listCommercial'));
                }

                // ----------------------------------
                // On demande à la vue d'afficher la liste des commandes
                // ----------------------------------
                return $this->render('commercial/list.html.twig', ['listCom' => $list, 'nbCompany' => $nbsCompany, 'nbContact' => $nbsContact, 'commercialTeamLink' => true]);
                // On affecte notre tableau contenant la(les) valeur(s) de la variable à la vue
                }
            
            else {
                return $this->redirect($this->generateUrl('index'));
            }
        }

        else {

            return $this->redirect($this->generateUrl('login'));
        }
    }
}
