<?php

namespace App\Form;

use App\Entity\Reclamation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class ReclamationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
         $builder
        ->add('objet', TextType::class, [
            'label' => 'Objet de la réclamation',
            'constraints' => [
                new NotBlank(['message' => 'L\'objet est obligatoire.']),
                new Length([
                    'min' => 6,
                    'minMessage' => 'L\'objet doit comporter au moins {{ limit }} caractères.',
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
        ->add('date_reclamation', DateType::class, [
            'label' => 'Date de réclamation',
            'widget' => 'single_text', // pour datepicker HTML5
            'constraints' => [
                new NotBlank(['message' => 'La date de réclamation est obligatoire.']),
            ],
        ])
        ->add('statut', ChoiceType::class, [
            'label' => 'Statut',
            'choices' => [
                'En cours' => 'en_cours',
                'Résolu' => 'resolu',
                'Ignoré' => 'ignore',
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
            'data_class' => Reclamation::class,
        ]);
    }
}
