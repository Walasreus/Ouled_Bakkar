<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label'=> "Votre email",
                'attr'=> [
                    'placeholder'=> 'Merci de saisir votre email'
                ]
            ])
            ->add('password', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identique',
                'options' => ['attr' => ['class' => 'password-field',
                'autocomplete' => 'new-password'
                ]],
                'required' => true,
         
                'first_options'  => ['label' => 'Mot de passe',
                                    'attr' => [ 'placeholder' =>'Merci de saisir votre mot de passe']],
                'second_options' => ['label' => 'Confirmez votre mot de passe',
                                    'attr' => [ 'placeholder' =>'Merci de confirmer votre mot de passe']],
                // 'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entre un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit avoir au minimum {{ limit }} caractères ',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('lastname', TextType::class, [
                'label'=> "Votre nom",
                'constraints' => new Length([
                    'min' => 2,
                    'minMessage' => 'Votre nom doit avoir au mininum {{ limit }} caractères',
                    'max' => 30,
                    'maxMessage' => 'Votre nom ne doit pas dépasser {{ limit }} caractères',
            ]),
                'attr'=> [
                    'placeholder'=> 'Merci de saisir votre nom'
                ]
            ])
            ->add('firstname', TextType::class, [
                'label'=> "Votre prénom",
                'constraints' => new Length([
                    'min' => 2,
                    'minMessage' => 'Votre prénom doit avoir au mininum {{ limit }} caractères',
                    'max' => 30,
                    'maxMessage' => 'Votre prénom ne doit pas dépasser {{ limit }} caractères',
            ]),
                'attr'=> [
                    'placeholder'=> 'Merci de saisir votre prénom'
                ]
            ])
            ->add('number', TextType::class, [
                'label'=> "Votre numéro de téléphone",
                'constraints' => new Length([
                    'min' => 10,
                    'minMessage' => 'Votre numéro doit avoir au mininum {{ limit }} caractères',
                    'max' => 30,
                    'maxMessage' => 'Votre numéro ne doit pas dépasser {{ limit }} caractères',
            ]),
                'attr'=> [
                    'placeholder'=> 'Merci de saisir votre numéro de téléphone'
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => "Vous devez accepter nos conditions d'utilisation.",
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => "S'inscrire"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
