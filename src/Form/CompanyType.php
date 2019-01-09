<?php

namespace App\Form;

use App\Entity\Company;
use App\Entity\Commercial;
use App\Entity\CompanyActivitySector;
use App\Entity\CompanyBusinessCategory;
use App\Entity\CompanyCountry;
use App\Entity\CompanyTurnover;
use App\Entity\CompanyLastTurnover;
use App\Entity\CompanyLegalStatus;
use App\Entity\CompanyNbEmployee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CompanyType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder			
			->add('CompanyCode', TextType::class, array('label' => 'Code de l\'entreprise'))
			->add('CompanyLastName', TextType::class, array('label' => 'Nom de l\'entreprise'))
			->add('CompanyDateCreatedPlug', DateType::class, array('label' => 'Date de création de la fiche'))
			->add('CompanyDateUpdate', DateType::class, array('label' => 'Date de la dernière mise à jour'))
			->add('CompanyCodeCommercial', TextType::class, array('label' => 'Code du commercial'))
			->add('CompanyStatus', CheckboxType::class, array('label' => 'Status de l\'entreprise (Active / Inactive)'))
			->add('CompanyLogo', TextType::class, array('label' => 'Logo de l\'entreprise'))
			->add('CompanyComments', TextareaType::class, array('label' => 'Commentaires','attr' => array('class' => 'tinymce')))
			->add('CompanyAddress', TextType::class, array('label' => 'Adresse de l\'entreprise'))
			->add('CompanyAddressSupplement', TextType::class, array('label' => 'Adresse supplémentaire de l\'entreprise'))
			->add('CompanyPostalCode', TextType::class, array('label' => 'Code postale'))
			->add('CompanyCity', TextType::class, array('label' => 'Ville'))
			->add('CompanyStandardPhone', TextType::class, array('label' => 'Numéro de téléphone'))
			->add('CompanyFax', TextType::class, array('label' => 'Fax'))
			->add('CompanyWebSite', TextType::class, array('label' => 'URL du site web'))
			->add('CompanyCreationDate', DateType::class, array('label' => 'Date de création de l\'entreprise'))
			->add('CompanySiret', TextType::class, array('label' => 'N° de siret de l\'entreprise'))
			->add('CompanyCodeNAF', TextType::class, array('label' => 'Code NAF'))
			->add('CompanySource', TextType::class, array('label' => 'Source'))
			->add('idCompanyCountry', EntityType::class, array('class' => CompanyCountry::class,'choice_label' => 'label', 'label'=>'Pays'))
			->add('idCompanyLegalStatus', EntityType::class, array('class' => CompanyLegalStatus::class,'choice_label' => 'label', 'label'=>'Status légal'))
			->add('idUser', EntityType::class, array('class' => Commercial::class,'choice_label' => 'CommercialName', 'label'=>'Utilisateur'))
			->add('idCompanyActivitySector', EntityType::class, array('class' => CompanyActivitySector::class,'choice_label' => 'label', 'label'=>'Secteur d\'activité'))
			->add('idCompanyBusinessCategory', EntityType::class, array('class' => CompanyBusinessCategory::class,'choice_label' => 'label', 'label'=>'Catégorie d\'affaire'))
			->add('idCompanyNbEmployee', EntityType::class, array('class' => CompanyNbEmployee::class,'choice_label' => 'nbEmployee', 'label'=>'Nombre d\'employés'))
			->add('idCompanyTurnover', EntityType::class, array('class' => CompanyTurnover::class,'choice_label' => 'turnover', 'label'=>'Chiffre d\'affaire (en M€)'))
			->add('idCompanyLastTurnover', EntityType::class, array('class' => CompanyLastTurnover::class,'choice_label' => 'turnover', 'label'=>'Dernier chiffre d\'affaire'))
	        ->add('save', SubmitType::class, array('label' => 'Valider'))
	        ->getForm();
	}
}
?>