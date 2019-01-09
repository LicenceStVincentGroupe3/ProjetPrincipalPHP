<?php
namespace App\Form;

use App\Entity\ParameterTypeSite;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ParameterTypeSiteType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder     
			->add('ParameterTypeSiteLabel', TextType::class, array('label' => 'Type de site'))

            ->add('save', SubmitType::class, array('label' => 'Enregistrer'))
            ->getForm()
    	;
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
		'data_class' => ParameterTypeSite::class]);	
	}
}
?>