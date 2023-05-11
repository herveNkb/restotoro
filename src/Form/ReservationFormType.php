<?php

namespace App\Form;

use App\Entity\Reservations;
use App\Entity\ReservationsSettings;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\Regex;


class ReservationFormType extends AbstractType
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this -> doctrine = $doctrine;
    }


    // Function to get the time slots for the reservation form
    private function getReservationTimeSlots(): array
    {
        // Get the reservations settings
        $reservationsSettings = $this -> doctrine
            -> getRepository(ReservationsSettings::class)
            -> findOneBy([]);

        // If no reservations settings are found, throw an exception
        if (!$reservationsSettings) {
            throw new \Exception('Aucun paramètre de réservation n\'a été configuré.');
        }

        // Get the opening and closing times for lunch and dinner
        $lunchOpeningTime = $reservationsSettings -> getLunchOpeningTime();
        $lunchClosingTime = $reservationsSettings -> getLunchClosingTime();
        $dinnerOpeningTime = $reservationsSettings -> getDinnerOpeningTime();
        $dinnerClosingTime = $reservationsSettings -> getDinnerClosingTime();


        // Get the time slots for lunch and dinner
        $interval = new \DateInterval('PT15M'); // 15 minute intervals
        $timeSlots = [];

        // For lunch
        $period = new \DatePeriod($lunchOpeningTime, $interval, $lunchClosingTime);
        foreach ($period as $dt) {
            $time = $dt -> format('H:i');
            $timeSlots[$time] = $time;
        }

        // For dinner
        $period = new \DatePeriod($dinnerOpeningTime, $interval, $dinnerClosingTime);
        foreach ($period as $dt) {
            $time = $dt -> format('H:i');
            $timeSlots[$time] = $time;
        }

        return $timeSlots;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            -> add('name', TextType::class, [
                'label' => 'Nom',
                'constraints' => [
                    new Regex('/^[a-zA-ZÀ-ÖØ-öø-ÿ\s]+$/u',
                        "Le Nom ne doit contenir que des lettres, sans caractères spéciaux, ni chiffres")
                ],
            ])
            -> add('dateReservation', DateType::class, [
                'label' => 'Date de réservation',
                'placeholder' => 'Choisir une date',
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
                'html5' => true,
                'format' => 'yyyy-MM-dd',
                'attr' => [
                    'autocomplete' => 'off',
                ],
            ])
            -> add('hourReservation', ChoiceType::class, [
                'label' => 'Heure de réservation',
                'choices' => $this -> getReservationTimeSlots(),
                'placeholder' => 'Choisir une heure',
                'required' => true,
                'expanded' => false,
                'multiple' => false,
                'attr' => [
                    'autocomplete' => 'off',
                ],
            ])
            -> add('customerNumber', IntegerType::class, [
                'label' => 'Nombre de convives',
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
            ])
            -> add('allergies', TextareaType::class, [
                'label' => 'Allergies - (Séparez les allergies par un trait d\'union)',
                'required' => false,
                'attr' => [
                    'class' => 'auto-resize'
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver -> setDefaults([
            'data_class' => Reservations::class,
        ]);
    }
}
