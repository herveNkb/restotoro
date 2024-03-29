<?php

namespace App\Repository;

use App\Entity\Openings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Openings>
 *
 * @method Openings|null find($id, $lockMode = null, $lockVersion = null)
 * @method Openings|null findOneBy(array $criteria, array $orderBy = null)
 * @method Openings[]    findAll()
 * @method Openings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OpeningsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent ::__construct($registry, Openings::class);
    }

    public function save(Openings $entity, bool $flush = false): void
    {
        $this -> getEntityManager() -> persist($entity);

        if ($flush) {
            $this -> getEntityManager() -> flush();
        }
    }

    public function remove(Openings $entity, bool $flush = false): void
    {
        $this -> getEntityManager() -> remove($entity);

        if ($flush) {
            $this -> getEntityManager() -> flush();
        }
    }

}
