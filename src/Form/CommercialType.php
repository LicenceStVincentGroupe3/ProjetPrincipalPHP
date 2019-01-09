<?php

namespace App\Form;

use App\Entity\Commercial;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;//FileType

class CommercialType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $option)
	{
		$builder
			->add('commercialCode', TextType::class, ['label' => 'Code du commercial*'])
			->add('commercialName', TextType::class, ['label' => 'Nom du commercial*'])
			->add('commercialFirstname', TextType::class, ['label' => 'Prénom du commercial*'])
			->add('commercialSexe', ChoiceType::class, ['choices'  => [
								        								'Homme' => true,
													        			'Femme' => false,
													    			]
													  ]
				)
			->add('commercialProfil', TextType::class, ['label' => 'Profil du commercial*'])
			->add('commercialStatus', CheckboxType::class, ['label' => 'Actif', 'required' => false])
			->add('commercialBirthday', DateTimeType::class, ['label' => 'Date de naissance du commercial'])
			->add('commercialPhone', TelType::class, ['label' => 'Tel du commercial', 'required' => false])
			->add('commercialMobilePhone', TelType::class, ['label' => 'Tel. portable du commercial', 'required' => false])
			->add('commercialEmail', EmailType::class, ['label' => 'Email du commercial', 'required' => false])
			->add('commercialLinkedinAddress', UrlType::class, ['label' => 'Lien LinkedIn du commercial', 'required' => false])
			->add('commercialPhoto', TextType::class, ['label' => 'Photo du commercial', 'required' => false])
			->add('save', SubmitType::class, ['label' => 'Valider'])
			->getForm()
		;
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(['data_class' => Commercial::class]);
	}
}

?>