<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Nom d’utilisateur',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Veuillez entrer un nom d’utilisateur.']),
                    new Assert\Length([
                        'min' => 3,
                        'minMessage' => 'Votre nom d’utilisateur doit contenir au moins {{ limit }} caractères.',
                        'max' => 50,
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse e-mail',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Veuillez entrer une adresse e-mail.']),
                    new Assert\Email(['message' => 'L’adresse e-mail n’est pas valide.']),
                ],
            ])
            ->add('birthday', DateType::class, [
                'widget' => 'single_text', // Permet d'utiliser un champ input type="date"
                'input' => 'datetime', // Stocke sous forme d'objet DateTime
                'format' => 'yyyy-MM-dd',
                'html5' => true,
                'required' => false,
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Veuillez entrer votre date de naissance.']),
                    new Assert\Date(['message' => 'Veuillez entrer une date valide.']),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'Mot de passe',
                ],
                'second_options' => [
                    'label' => 'Confirmer le mot de passe',
                ],
                'invalid_message' => 'Les mots de passe doivent correspondre.',
                'mapped' => false, // Ce champ n’est pas directement lié à l’entité User
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Veuillez entrer un mot de passe.']),
                    new Assert\Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères.',
                        'max' => 4096,
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class, // L'entité associée à ce formulaire
        ]);
    }
}
