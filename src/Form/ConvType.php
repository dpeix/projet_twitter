<?php

namespace App\Form;

use App\Entity\Conv;
use App\Entity\User;
use App\Entity\ConvUser;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Champ pour sélectionner un utilisateur avec qui démarrer la conversation
            ->add('convUsers', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'username', // Affiche le nom d'utilisateur
                'multiple' => true,
                'mapped' => false,
                'label' => 'Sélectionner un utilisateur',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Créer la conversation',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Conv::class,
        ]);
    }
}
