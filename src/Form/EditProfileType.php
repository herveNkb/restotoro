<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class EditProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Récupération des données de l'utilisateur et le stocke dans $options['data']
        $defaultAllergies = $options['data']->getDefaultAllergies();
        $defaultCustomerNumber = $options['data']->getDefaultCustomerNumber();

        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
               'constraints' => [
                    new Regex('/^[a-zA-Z]+$/',
                        "Le nom ne doit contenir que des lettres, sans accents")
                ],
            ])
            ->add('first_name', TextType::class, [
                'label' => 'Prénom',
                'constraints' => [
                    new Regex('/^[a-zA-Z]+$/',
                        "Le nom ne doit contenir que des lettres, sans accents")
                ],
            ])
            ->add('email', TextType::class, [
                'empty_data' => '$options["data"]->getEmail() ?? null',
            ])
            ->add('default_allergies', TextType::class,[
                // vérifie si la valeur est null, si oui, on met une valeur par défaut
            'empty_data' =>  $defaultAllergies !== null ? $defaultAllergies : null,
                'required' => false,
                ])
            ->add('default_customer_number', IntegerType::class, [
                // vérifie si la valeur est null, si oui, on met une valeur par défaut
                'empty_data' => $defaultCustomerNumber !== null ? $defaultCustomerNumber : null,
                'required' => false,
            ])
        ;
    }

    // Permet de lier le formulaire à la classe Users
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
           'data_class' => Users::class,
        ]);
    }
}
