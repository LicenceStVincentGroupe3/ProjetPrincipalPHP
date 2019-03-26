<?php

namespace App\AdminBundle\Form;

use App\AdminBundle\Entity\Commercial;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class CommercialType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $option)
	{
		$builder
			->add('commercialCode', TextType::class, ['label' => 'Code collaborateur'])
			->add('commercialName', TextType::class, ['label' => 'Nom'])
			->add('commercialFirstname', TextType::class, ['label' => 'Prénom'])
			->add('commercialSexe', ChoiceType::class, [
				'choices'  => [
					'Homme' => true,
					'Femme' => false
				]
			])
			->add('commercialJob', TextType::class, ['label' => 'Fonction/poste', 'required' => false])
			->add('commercialStatus', CheckboxType::class, ['label' => 'Actif', 'required' => false])
			->add('commercialBirthday', DateTimeType::class, ['label' => 'Date de naissance'])
			->add('arrivalDate', DateTimeType::class, ['label' => 'Date d\'arrivée', 'required' => false])
			->add('departureDate', DateTimeType::class, ['label' => 'Date de départ', 'required' => false])
			->add('commercialPhone', TelType::class, ['label' => 'Tél. fixe direct', 'required' => false])
			->add('commercialMobilePhone', TelType::class, ['label' => 'Tél. mobile', 'required' => false])
			->add('commercialLinkedinAddress', UrlType::class, ['label' => 'Profil LinckedIn', 'required' => false])
			->add('commercialFacebookAddress', UrlType::class, ['label' => 'Profil Facebook', 'required' => false])
			->add('commercialTwitterAddress', UrlType::class, ['label' => 'Profil Twitter', 'required' => false])
			->add('commercialPhoto', FileType::class, ['label' => 'Photo', 'required' => false])
			->add('remarks', TextareaType::class, ['label' => 'Remarques', 'required' => false])
			->add('email', EmailType::class, ['label' => 'E-mail', 'required' => false])
            ->add('plainPassword', PasswordType::class, ['label' => 'Mot de passe', 'required' => false])
            ->add('save', SubmitType::class, ['label'=>'Valider'])
			->getForm()
		;
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(['data_class' => Commercial::class]);
	}
}

?>
