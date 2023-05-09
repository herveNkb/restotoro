<?php

namespace App\Form;

use App\Entity\Reservations;
use App\Entity\ReservationsSettings;
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
use Doctrine\Persistence\ManagerRegistry;


class ReservationFormType extends AbstractType
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this -> doctrine = $doctrine;
    }

    private function getReservationTimeSlots(): array
    {
        $reservationsSettings = $this -> doctrine
            -> getRepository(ReservationsSettings::class)
            -> findOneBy([]);

        if (!$reservationsSettings) {
            throw new \Exception('Aucun paramètre de réservation n\'a été configuré.');
        }

        $lunchOpeningTime = $reservationsSettings -> getLunchOpeningTime();
        $lunchClosingTime = $reservationsSettings -> getLunchClosingTime();
        $dinnerOpeningTime = $reservationsSettings -> getDinnerOpeningTime();
        $dinnerClosingTime = $reservationsSettings -> getDinnerClosingTime();

        $interval = new \DateInterval('PT15M'); // Tranche de 15 minutes
        $timeSlots = [];

        $period = new \DatePeriod($lunchOpeningTime, $interval, $lunchClosingTime);
        foreach ($period as $dt) {
            $time = $dt -> format('H:i');
            $timeSlots[$time] = $time;
        }

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
                    new Regex('/^[a-zA-Z]+$/',
                        "Le nom ne doit contenir que des lettres, sans accents")
                ],
            ])
            -> add('dateReservation', DateType::class, [
                'label' => 'Date de réservation',
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
                'html5' => true,
                'format' => 'yyyy-MM-dd',
                'attr' => [
                    'class' => 'form-datepicker',
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
                    'class' => 'js-timepicker',
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
