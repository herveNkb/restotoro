<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'Vous acceptez que votre email soit utilisé pour pouvoir vous connecter',
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous acceptez que votre email soit utilisé pour pouvoir vous connecter.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new Regex('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{12,}$/',
                    "Il faut un mot de passe de 12 caractères, avec au minimum une majuscule, une minuscule, un chiffre et un caractère spécial")
                ],
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Nom'
                ],
                'constraints' => [
                    new Regex('/^[a-zA-Z]+$/',
                        "Le prénom ne doit contenir que des lettres, sans accents")
                ],
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'Prénom'
                ],
                'constraints' => [
                    new Regex('/^[a-zA-Z]+$/',
                        "Le nom ne doit contenir que des lettres, sans accents")
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
