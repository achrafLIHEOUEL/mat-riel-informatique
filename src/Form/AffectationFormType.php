<?php

namespace App\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Affectation;
use App\Entity\User;
use App\Entity\Materiel;
use App\Form\AffectationType;

class AffectationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('User', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'nom', 
                'label' => 'Employé',
            ])
            ->add('Materiel', EntityType::class, [
                'class' => Materiel::class,
                'choice_label' => 'type', 
                'label' => 'Matériel',
            ])
            ->add('date_affectation', DateTimeType::class, [
                'label' => 'Date d\'affectation',
                'widget' => 'single_text',
            ])
              ->add('date_retour', DateTimeType::class, [
                'label' => 'Date de retour',
                'widget' => 'single_text',
           
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
