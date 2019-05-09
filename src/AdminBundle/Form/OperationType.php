<?php

namespace App\AdminBundle\Form;

use App\AdminBundle\Entity\Operation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OperationType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $option)
	{
		$builder
			->add('operationCode', TextType::class, ['label' => 'Code opération'])
			->add('operationName', TextType::class, ['label' => 'Nom de l\'opération'])
			->add('emailSubject', TextType::class, ['label' => 'Objet du email', 'required' => false])
			/*->add('nbAutoRelaunching', ChoiceType::class, [
				'choices'  => [
					'5' => 5,
					'10' => 10,
					'15' => 15
				]
			])*/
			->add('nbAutoRelaunching', IntegerType::class, ['label' => 'Nb de relance auto', 'required' => false])
			->add('sendingDate', DateType::class, ['label' => 'Date d\'envoi', 'required' => false,
				'widget' => 'single_text'
			])
			->add('closingDate', DateType::class, ['label' => 'Date de clôture', 'required' => false,
				'widget' => 'single_text'
			])
			->add('infos', CheckboxType::class, ['label' => 'Informations', 'required' => false])
			->add('commercialOffer', CheckboxType::class, ['label' => 'Offre commerciale', 'required' => false])
			->add('remarks', TextareaType::class, ['label' => 'Remarques', 'required' => false])
			->add('save', SubmitType::class, ['label' => 'Valider'])
			->getForm()
		;
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(['data_class' => Operation::class]);
	}
}

?>
