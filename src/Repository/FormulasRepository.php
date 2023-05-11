<?php

namespace App\Repository;

use App\Entity\Formulas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Formulas>
 *
 * @method Formulas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Formulas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Formulas[]    findAll()
 * @method Formulas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormulasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent ::__construct($registry, Formulas::class);
    }

    public function save(Formulas $entity, bool $flush = false): void
    {
        $this -> getEntityManager() -> persist($entity);

        if ($flush) {
            $this -> getEntityManager() -> flush();
        }
    }

    public function remove(Formulas $entity, bool $flush = false): void
    {
        $this -> getEntityManager() -> remove($entity);

        if ($flush) {
            $this -> getEntityManager() -> flush();
        }
    }

}
