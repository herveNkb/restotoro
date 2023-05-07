<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\Regex;

class EditProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Récupération des données de l'utilisateur et le stocke dans $options['data']
        $defaultAllergies = $options['data'] -> getDefaultAllergies();
        $defaultCustomerNumber = $options['data'] -> getDefaultCustomerNumber();

        $builder
            -> add('name', TextType::class, [
                'label' => 'Nom',
                'constraints' => [
                    new Regex('/^[a-zA-Z]+$/',
                        "Le nom ne doit contenir que des lettres, sans accents")
                ],
            ])
            -> add('first_name', TextType::class, [
                'label' => 'Prénom',
                'constraints' => [
                    new Regex('/^[a-zA-Z]+$/',
                        "Le nom ne doit contenir que des lettres, sans accents")
                ],
            ])
            -> add('email', TextType::class, [
                'label' => 'Email',
                'empty_data' => '$options["data"]->getEmail() ?? null',
                'constraints' => [
                    new Regex('/^[^\s@]+@[^\s@]+\.[^\s@]+$/',
                        "Veuillez entrer une adresse email valide.")
                ],
            ])
            -> add('default_allergies', TextareaType::class, [
                'label' => 'Allergies - (Séparez les allergies par un trait d\'union)',
                'attr' => [
                    'class' => 'auto-resize'
                ],
                // vérifie si la valeur est null, si oui, on met une valeur par défaut
                'empty_data' => $defaultAllergies !== null ? $defaultAllergies : null,
                'required' => false,
            ])
            -> add('default_customer_number', IntegerType::class, [
                'label' => 'Nombre de convives',
                // vérifie si la valeur est null, si oui, on met une valeur par défaut
                'empty_data' => $defaultCustomerNumber !== null ? $defaultCustomerNumber : null,
                'required' => false,
                'constraints' => [
                    new Regex([
                        'pattern' => '/^(?!.*\d{3,})\d+$/',
                        'message' => 'Le nombre de convives doit être une valeur numérique avec un maximum de deux chiffres consécutifs.',
                    ]),
                    new GreaterThanOrEqual([
                        'value' => 1,
                        'message' => 'Le nombre de convives doit être au moins de {{ compared_value }}.',
                    ]),
                    new LessThanOrEqual([
                        'value' => 20,
                        'message' => 'Le nombre de convives ne peut pas dépasser {{ compared_value }}.',
                    ]),
                ],
            ]);
    }

    // Permet de lier le formulaire à la classe Users
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver -> setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
