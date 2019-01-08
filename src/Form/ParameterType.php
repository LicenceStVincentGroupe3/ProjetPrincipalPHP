<?php

namespace App\Form;

use App\Entity\Parameter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;//FileType

class ParameterType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $option)
	{
		$builder
			->add('parameterAppliName', TextType::class, ['label' => 'Nom de l\'application pour le client*'])
			->add('parameterCustomerLogo', TextType::class, ['label' => 'Logo du client*'])
			->add('parameterAddress', TextType::class, ['label' => 'Adresse*'])
			->add('parameterEmail', EmailType::class, ['label' => 'Email (affiché dans la page contact)*', 'required' => false])
			->add('parameterPhone', TelType::class, ['label' => 'Tel.', 'required' => false])
			->add('parameterFax', TextType::class, ['label' => 'Fax', 'required' => false])
			->add('parameterEmailAdminAlert', EmailType::class, ['label' => 'Email qui reçoit les alertes administrateur', 
																	'required' => false
																]
					)
			->add('parameterEmailContactForm', EmailType::class, ['label' => 'Email qui reçoit les demandes envoyées par le
																	formulaire de contact', 'required' => false
																]
					)
			->add('parameterComplement', TextareaType::class, ['label' => 'Complément', 'attr' => ['class' => 'tinymce'],
																'required' => false
																]
					)
			->add('idParameterContactJob', CollectionType::class, [/*'label'=> 'Job (du contact)',*/'by_reference' => false])
			->add('save', SubmitType::class, ['label' => 'Valider'])
			->getForm()
		;
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(['data_class' => Parameter::class]);
	}
}

?>