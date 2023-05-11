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

    // function to count the number of existing reservations for a given date
    public function countReservationsForDate(\DateTimeInterface $dateReservation): int
    {
        return $this -> createQueryBuilder('r') // r is the alias of the Reservations table
        -> select('COUNT(r.id)') // counts the number of total reservations for a given date
        -> where('r.dateReservation = :date') // filters reservations for a given date
        -> setParameter('date', $dateReservation) // binds the date parameter to the booking date
        -> getQuery() // build the query
        -> getSingleScalarResult(); // executes the query and returns a single result (scalar = a single result)
    }

    // Function to count the total number of customers for a given date
    public function countTotalCustomersForDate(\DateTimeInterface $dateReservation): int
    {
        return $this -> createQueryBuilder('r') // r is the alias of the Reservations table
        -> select('COALESCE(SUM(r.customer_number), 0)') // sum the number of customers for a given date (COALESCE returns 0 if the sum is zero)
        -> where('r.dateReservation = :date')
            -> setParameter('date', $dateReservation)
            -> getQuery()
            -> getSingleScalarResult();
    }

}
