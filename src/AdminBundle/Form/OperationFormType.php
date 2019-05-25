<?php

namespace App\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use App\AdminBundle\Entity\OperationForm;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OperationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('contactsSexe', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true
        ])->add('contactsFirstname', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true
        ])->add('contactsName', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true
        ])->add('contactsBirthday', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true
        ])->add('contactsMailPro', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true
        ])->add('contactsMobilePhone', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true
        ])->add('contactsPhone', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true
        ])
        ->add('contactsLinkedinAddress', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true
        ])
        ->add('contactsTwitterAddress', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true
        ])
        ->add('contactsFacebookAddress', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true
        ])->add('contactsJob', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true
        ])->add('contactsPoste', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true
        ])->add('companyName', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true
        ])->add('companyNaf', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true
        ])->add('companyLegalStatus', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true
        ])->add('companySiret', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true
        ])->add('companyNbEmployees', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true
        ])->add('companyAddress', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true
        ])->add('companyTurnovers', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true
        ])->add('companyPostalCode', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true
        ])->add('companyCountry', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true
        ])->add('companyStandardPhone', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true
        ])->add('companyFax', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true
        ])->add('companyWebsite', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true
        ])->add('companyEmail', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true
        ])->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OperationForm::class,
        ]);
    }
}
