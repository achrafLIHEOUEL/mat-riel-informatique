<?php

namespace App\Form;

use App\Entity\Alerte;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class AlerteFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
          $builder
        ->add('type', TextType::class, [
            'label' => 'Type d\'alerte',
            'constraints' => [
                new NotBlank(['message' => 'Le type d\'alerte est obligatoire.']),
                new Length([
                    'min' => 6,
                    'minMessage' => 'Le type doit comporter au moins {{ limit }} caractères.',
                
                ]),
            ],
        ])
        ->add('message', TextType::class, [
            'label' => 'Message',
            'constraints' => [
                new NotBlank(['message' => 'Le message est obligatoire.']),
                new Length([
                    'min' => 10,
                    'minMessage' => 'Le message doit comporter au moins {{ limit }} caractères.',
                    
                ]),
            ],
        ])
        ->add('date_alerte', DateType::class, [
            'label' => 'Date de l\'alerte',
            'widget' => 'single_text', // datepicker HTML5
            'constraints' => [
                new NotBlank(['message' => 'La date de l\'alerte est obligatoire.']),
            ],
        ])
        ->add('statut', ChoiceType::class, [
            'label' => 'Statut',
            'choices' => [
                'En cours' => 'en_cours',
                'Résolu' => 'resolu',
            
            ],
            'placeholder' => 'Choisir un statut',
            'constraints' => [
                new NotBlank(['message' => 'Veuillez sélectionner un statut.']),
            ],
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Alerte::class,
        ]);
    }
}
