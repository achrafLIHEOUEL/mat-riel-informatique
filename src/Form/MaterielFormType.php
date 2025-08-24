<?php

namespace App\Form;

use App\Entity\Materiel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Choice;


class MaterielFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           ->add('type', ChoiceType::class, [
            'label' => 'type',
            'choices' => [
                'Pc poste' => 'pc poste',
                'Pc portable' => 'pc portable',
                'Imprimante' => 'imprimante',
                'Scanner' => 'scanner',
                'Serveur' => 'serveur',
                'Routeur' => 'routeur',
                'Téléphone' => 'telephone',
            ],
            'placeholder' => 'Choisir un type',
            'constraints' => [
                new NotBlank(['message' => 'Veuillez sélectionner une type.']),
            ],
        ])
           ->add('marque', TextType::class, [
        'label' => 'Marque',
        'constraints' => [
            new NotBlank(['message' => 'La marque est obligatoire.']),
        ],
        'attr' => ['class' => 'form-control', 'placeholder' => 'Ex: HP']
    ])
             ->add('modele', TextType::class, [
        'label' => 'Modèle',
        'constraints' => [
            new NotBlank(['message' => 'Le modèle est obligatoire.']),
        ],
        'attr' => ['class' => 'form-control', 'placeholder' => 'Ex: Pavilion 15']
    ])
            ->add('numeroSerie', TextType::class, [
        'label' => 'Numéro de série',
        'constraints' => [
            new NotBlank(['message' => 'Le numéro de série est obligatoire.']),
        ],
        'attr' => ['class' => 'form-control', 'placeholder' => 'Ex: SN123456']
    ])
            ->add('etat', ChoiceType::class, [
        'label' => 'État du matériel',
        'choices' => [
            'Neuf' => 'neuf',
            'Bon état' => 'bon',
            'Usagé' => 'usage',
           
        ],
        'expanded' => true,  // checkbox
        'multiple' => false,  // si tu veux permettre plusieurs états
        'constraints' => [
            new NotBlank(['message' => 'Veuillez sélectionner au moins un état.']),
            new Choice([
                'choices' => ['neuf','bon','usage','defectueux'],
                'message' => 'État invalide.',
            ])
        ],
    ])
         ->add('dateAcquisition', DateType::class, [
        'label' => 'Date d\'acquisition',
        'widget' => 'single_text',
        'constraints' => [
            new NotBlank(['message' => 'La date d\'acquisition est obligatoire.']),
        ],
        'attr' => ['class' => 'form-control']
    ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Materiel::class,
        ]);
    }
}
