<?php

namespace App\AdminBundle\Form;

use Doctrine\ORM\EntityRepository;
use App\AdminBundle\Entity\CompanyCountry;
use App\AdminBundle\Entity\CompanyTurnover;
use App\AdminBundle\Entity\ContactJob;
use App\AdminBundle\Entity\CompanyActivitySector;
use Symfony\Component\Form\AbstractType;
use App\AdminBundle\Entity\CompanyNbEmployee;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\AdminBundle\Entity\ContactOperation;

class ContactOperationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contactOperationContactSexe', ChoiceType::class, [
                'choices'  => [
                    'Homme' => "Homme",
                    'Femme' => "Femme"

                ]
            ])
            ->add('contactOperationContactName', TextType::class, ["label" => "Nom", "required" => false])
            ->add('contactOperationContactFirstName', TextType::class, ["label" => "Prénom", "required" => false])
            ->add('contactOperationContactBirthday', DateType::class, [
                "label" => "Date de naissance", "required" => false,
                'widget' => 'single_text'
            ])
            ->add('contactOperationContactEmail', EmailType::class, ["label" => "E-mail", "required" => false])
            ->add('contactOperationContactMobilePhone', TelType::class, ["label" => "Tél. mobile", "required" => false])
            ->add('contactOperationContactPhone', TelType::class, ["label" => "Tél. Fixe", "required" => false])
            ->add('contactOperationContactLinkedinAddress', UrlType::class, ["label" => "Profil Linkedin", "required" => false])
            ->add('contactOperationContactFacebookAddress', UrlType::class, ["label" => "Profil Facebook", "required" => false])
            ->add('contactOperationContactTwitterAddress', UrlType::class, ["label" => "Profil Twitter", "required" => false])
            ->add('contactJob', EntityType::class, [
                'label' => "Métier",
                'class' => ContactJob::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('cj')
                        ->orderBy('cj.contactJobName', 'ASC');
                },
                "required" => false
            ])
            ->add('contactOperationContactworkName', TextType::class, ["label" => "Nom du poste", "required" => false])
            ->add('contactOperationName', TextType::class, ["label" => "Nom", "required" => false])
            ->add('companyActivitySector', EntityType::class, [
                "label" => "Activité (NAF)",
                'class' => CompanyActivitySector::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('cas')
                        ->orderBy('cas.label', 'ASC');
                },
                "required" => false
            ])
            ->add('contactOperationSiret', TextType::class, ["label" => "N°SIRET", "required" => false])
            ->add('companyNbEmployees', EntityType::class, [
                "label" => "Effectifs",
                'class' => CompanyNbEmployee::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('cne')
                        ->orderBy('cne.nbEmployee', 'ASC');
                },
                'choice_label' => "libelle",
                "required" => false
            ])
            ->add('companyTurnovers', EntityType::class, [
                "label" => "Chiffre d'affaires (M€)",
                'class' => CompanyTurnover::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('ct')
                        ->orderBy('ct.turnover', 'ASC');
                },
                'choice_label' => "libelle",
                "required" => false
            ])
            ->add('contactOperationAddress', TextType::class, ["label" => "Adresse", "required" => false])
            ->add('contactOperationPostalCode', TextType::class, ["label" => "Code postal", "required" => false])
            ->add('country', EntityType::class, [
                "label" => "Pays",
                'class' => CompanyCountry::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.label', 'ASC');
                }
            ])
            ->add('contactOperationCompanyEmail', EmailType::class, ["label" => "E-mail","required" => false])
            ->add('contactOperationCompanyPhone', TelType::class, ["label" => "Téléphone", "required" => false])
            ->add('contactOperationFax', TelType::class, ["label" => "Fax", "required" => false])
            ->add('contactOperationWebSite', UrlType::class, ["label" => "Site web", "required" => false]);
    }
}
