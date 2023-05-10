<?php

namespace App\Repository;

use App\Entity\Reservations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reservations>
 *
 * @method Reservations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservations[]    findAll()
 * @method Reservations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent ::__construct($registry, Reservations::class);
    }

    public function save(Reservations $entity, bool $flush = false): void
    {
        $this -> getEntityManager() -> persist($entity);

        if ($flush) {
            $this -> getEntityManager() -> flush();
        }
    }

    public function remove(Reservations $entity, bool $flush = false): void
    {
        $this -> getEntityManager() -> remove($entity);

        if ($flush) {
            $this -> getEntityManager() -> flush();
        }
    }

    // compte le nombre de réservations existantes pour une date donnée
    public function countReservationsForDate(\DateTimeInterface $dateReservation): int
    {
        return $this -> createQueryBuilder('r') // r est l'alias de la table Reservations
        -> select('COUNT(r.id)') // compte le nombre de réservations totales pour une date donnée
        -> where('r.dateReservation = :date') // filtre les réservations pour une date donnée
        -> setParameter('date', $dateReservation) // lie le paramètre date à la date de réservation
        -> getQuery() // construit la requête
        -> getSingleScalarResult(); // exécute la requête et retourne un résultat unique (scalaire = un seul résultat)
    }

    // compte le nombre total de clients pour une date donnée
    public function countTotalCustomersForDate(\DateTimeInterface $dateReservation): int
    {
        return $this -> createQueryBuilder('r') // r est l'alias de la table Reservations
        -> select('COALESCE(SUM(r.customer_number), 0)') // somme le nombre de clients pour une date donnée (COALESCE permet de retourner 0 si la somme est nulle)
        -> where('r.dateReservation = :date')
            -> setParameter('date', $dateReservation)
            -> getQuery()
            -> getSingleScalarResult();
    }

}
