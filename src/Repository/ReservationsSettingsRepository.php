<?php

namespace App\Repository;

use App\Entity\ReservationsSettings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReservationsSettings>
 *
 * @method ReservationsSettings|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationsSettings|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationsSettings[]    findAll()
 * @method ReservationsSettings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationsSettingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent ::__construct($registry, ReservationsSettings::class);
    }

    public function save(ReservationsSettings $entity, bool $flush = false): void
    {
        $this -> getEntityManager() -> persist($entity);

        if ($flush) {
            $this -> getEntityManager() -> flush();
        }
    }

    public function remove(ReservationsSettings $entity, bool $flush = false): void
    {
        $this -> getEntityManager() -> remove($entity);

        if ($flush) {
            $this -> getEntityManager() -> flush();
        }
    }

}
