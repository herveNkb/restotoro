<?php

namespace App\Repository;

use App\Entity\Menus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Menus>
 *
 * @method Menus|null find($id, $lockMode = null, $lockVersion = null)
 * @method Menus|null findOneBy(array $criteria, array $orderBy = null)
 * @method Menus[]    findAll()
 * @method Menus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MenusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent ::__construct($registry, Menus::class);
    }

    public function save(Menus $entity, bool $flush = false): void
    {
        $this -> getEntityManager() -> persist($entity);

        if ($flush) {
            $this -> getEntityManager() -> flush();
        }
    }

    public function remove(Menus $entity, bool $flush = false): void
    {
        $this -> getEntityManager() -> remove($entity);

        if ($flush) {
            $this -> getEntityManager() -> flush();
        }
    }

}
