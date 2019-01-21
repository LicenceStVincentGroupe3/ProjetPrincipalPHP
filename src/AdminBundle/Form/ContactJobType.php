<?php
namespace App\AdminBundle\Form;

use App\Entity\Contact;
use App\Entity\ContactJob;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FormType;

class ContactJobType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder     
			->add('contactJobName', TextType::class, array('label' => 'Nom du job'))

            ->add('save', SubmitType::class, array('label' => 'Enregistrer'))
            ->getForm()
    	;
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
		'data_class' => ContactJob::class]);	
	}
}
?>
