<?php

namespace App\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\AdminBundle\Entity\Commercial;
use App\AdminBundle\Form\CommercialType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

// Préfix url
/**
 * @Route("/commercial")
 */
class CommercialController extends AbstractController
{
    /**
     * @Route("/new", methods={"GET","POST"}, name="newCommercial")
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        if ($this->isGranted('ROLE_COMMERCIAL')) {

            if ($this->isGranted('ROLE_RESPONSABLE')) {
                $new = new Commercial();

                $form = $this->createForm(CommercialType::class, $new);

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
                }
                // Sinon
                else {
                    $form->add('commercialProfil', ChoiceType::class, [
                        'choices'  => [
                            'A définir' => null,
                            'Commercial' => 'ROLE_COMMERCIAL'
                        ]
                    ]);
                }
                
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST'))
                {
                    $new = $form->getData();

                    $password = $passwordEncoder->encodePassword($new, $new->getPlainPassword());
                    $role = $new->getCommercialProfil();
                    
                    $new->setPassword($password);
                    $new->addRole($role);

                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($new);
                    $entityManager->flush();
                    // ... do any other work - like sending them an email, etc
                    // maybe set a "flash" success message for the user
                    $this->addFlash('success', 'Votre compte à bien été enregistré.');
                    //return $this->redirectToRoute('login');

                    return $this->redirect($this->generateUrl('listCommercial'));
                }

                return $this->render('commercial/new.html.twig', ['form' => $form->createView(), 'commercialTeamLink' => true]);
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
    public function edit($id, Request $request)
    {
        if ($this->isGranted('ROLE_COMMERCIAL')) {

            if ($this->isGranted('ROLE_RESPONSABLE')) {
                // Appel de Doctrine
                $display = $this->getDoctrine()->getManager();

                // Variable qui contient le Repository
                $commercialRepository = $display->getRepository(Commercial::class);

                // Equivalent du SELECT * where id=(paramètre)
                $edit = $commercialRepository->find($id);

                $form = $this->createForm(CommercialType::class, $edit);

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
                }
                // Sinon
                else {
                    $form->add('commercialProfil', ChoiceType::class, [
                        'choices'  => [
                            'A définir' => null,
                            'Commercial' => 'ROLE_COMMERCIAL'
                        ]
                    ]);
                }

                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST'))
                {
                    $edit = $form->getData();

                    $role = $edit->getCommercialProfil();

                    $entityManager = $this->getDoctrine()->getManager();

                    $edit->setCommercialLastUpdate(new \DateTime());
                    $edit->addRole($role);

                    $entityManager->flush();

                    return $this->redirect($this->generateUrl('listCommercial'));
                }

                // ----------------------------------
                // On demande à la vue d'afficher la commande plus tous ses produits
                // ----------------------------------
                return $this->render('commercial/edit.html.twig', ['editCom' => $edit, 'form' => $form->createView(), 'commercialTeamLink' => true]);
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
    public function delete($id)
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
     * @Route("/list", name="listCommercial", methods={"GET"})
     */
    public function list()
    {
        if ($this->isGranted('ROLE_COMMERCIAL')) {
            
            if ($this->isGranted('ROLE_RESPONSABLE')) {
                // Appel de Doctrine
                $display = $this->getDoctrine()->getManager();

                // Variable qui contient le Repository
                $commercialRepository = $display->getRepository(Commercial::class);

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

                // ----------------------------------
                // On demande à la vue d'afficher la liste des commandes
                // ----------------------------------
                return $this->render('commercial/list.html.twig', ['listCom' => $list, 'commercialTeamLink' => true]);
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
