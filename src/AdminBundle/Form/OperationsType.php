<?php

namespace App\AdminBundle\Form;

use Doctrine\ORM\EntityRepository;
use App\AdminBundle\Entity\Operations;
use App\AdminBundle\Entity\Commercial;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OperationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('operationCode', TextType::class, ["label" => "Code opération", "required" => false])
            ->add('operationName', TextType::class, ["label" => "Nom de l'opération", "required" => false])
            ->add('operationRevival', ChoiceType::class, [
                'choices'  => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ],
                "label" => "Nb de relances auto",
                "required" => false
            ])
            ->add('operationSendingDate', DateType::class, ['label' => 'Date d\'envoi', 'required' => false,
                'widget' => 'single_text'
            ])
            ->add('operationClosingDate', DateType::class, ['label' => 'Date de clôture', 'required' => false,
                'widget' => 'single_text'
            ])
            ->add('operationComment', TextareaType::class, ["label" => "Remarques", "required" => false])
            ->add('author', EntityType::class, [
                "label" => "Auteur",
                'class' => Commercial::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.commercialName', 'ASC');
                },
                'required' => false
            ])
            ->add('operationOptInformation', CheckboxType::class, [
                'label'    => 'Information',
                'required' => false
            ])
            ->add('operationOptSalesOffer', CheckboxType::class, [
                'label'    => 'Offre commerciale',
                'required' => false
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Operations::class,
        ]);
    }
}
