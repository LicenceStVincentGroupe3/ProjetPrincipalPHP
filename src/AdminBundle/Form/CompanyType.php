<?php

namespace App\AdminBundle\Form;

use App\AdminBundle\Entity\Company;
use App\AdminBundle\Entity\Commercial;
use App\AdminBundle\Entity\CompanyActivitySector;
use App\AdminBundle\Entity\CompanyBusinessCategory;
use App\AdminBundle\Entity\CompanyCountry;
use App\AdminBundle\Entity\CompanyTurnover;
use App\AdminBundle\Entity\CompanyLastTurnover;
use App\AdminBundle\Entity\CompanyStatus;
use App\AdminBundle\Entity\CompanyNbEmployee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class CompanyType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		//, 'required' => false
		$builder
			->add('CompanyCode', TextType::class, array('label' => 'Code entreprise'))
			->add('CompanyLastName', TextType::class, array('label' => 'Nom'))
			->add('CompanyPotential', IntegerType::class, array('label' => 'Potentiel'))
			->add('CompanyDateUpdate', DateType::class, array('label' => 'Date de la dernière mise à jour'))
			->add('CompanyStatus', CheckboxType::class, array('label' => 'Status'))
			->add('CompanyEmail', DateType::class, array('label' => 'Email'))
			->add('CompanyLogo', FileType::class, ['label' => 'Logo', 'required' => false, 'data_class' => null])
			->add('CompanyComments', TextareaType::class, array('label' => 'Commentaires','attr' => array('class' => 'tinymce')))
			->add('CompanyAddress', TextType::class, array('label' => 'Adresse'))
			->add('CompanyPostalCode', TextType::class, array('label' => 'Code postal'))
			->add('CompanyCity', TextType::class, array('label' => 'Ville'))
			->add('CompanyStandardPhone', TextType::class, array('label' => 'Numéro de téléphone'))
			->add('CompanyFax', TextType::class, array('label' => 'Fax'))
			->add('CompanyWebSite', TextType::class, array('label' => 'URL du site web'))
			->add('CompanyCreationDate', DateType::class, array('label' => 'Date de création de l\'entreprise', 'widget' => 'single_text'))
			->add('CompanySiret', TextType::class, array('label' => 'N° SIRET'))
			->add('idCompanyCountry', EntityType::class, array('class' => CompanyCountry::class,'choice_label' => 'label', 'label'=>'Pays', 'placeholder'=>''))
			->add('idCompanyStatus', EntityType::class, array('class' => CompanyStatus::class,'choice_label' => 'label', 'label'=>'Status'))
			->add('idUser', EntityType::class, array('class' => Commercial::class,'choice_label' => 'CommercialName', 'label'=>'Compte suivi par', 'placeholder'=>''))
			->add('idCompanyActivitySector', EntityType::class, array('class' => CompanyActivitySector::class,'choice_label' => 'label', 'label'=>'Secteur d\'activité', 'placeholder'=>''))
			->add('idCompanyNbEmployee', EntityType::class, array('class' => CompanyNbEmployee::class,'choice_label' => 'nbEmployee', 'label'=>'Effectifs', 'placeholder'=>''))
			->add('idCompanyTurnover', EntityType::class, array('class' => CompanyTurnover::class,'choice_label' => 'turnover', 'label'=>'Chiffre d\'affaires', 'placeholder'=>''))
			->add('save', SubmitType::class, array('label' => 'Valider'))
	        ->getForm();
	}
}
?>
