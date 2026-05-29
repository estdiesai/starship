<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        return parent::__construct($registry, Category::class);
    }

    public function save (Category $entity, bool $flush = false): void
    {
        // hace que un nuevo objeto sea gestionado y guardado en la base de datos
        $this->getEntityManager()->persist($entity);

        if($flush)
        {
            // sincroniza el estado de tus objetos en memoria con la base de datos
            // muy utilizado en Symfony con Doctrine ORM
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Category $entity, bool $flush = false): void
    {
        // Marca un objeto o entidad para ser eliminado de la base de datos
        $this->getEntityManager()->remove($entity);

        if($flush)
        {
            // sincroniza el estado de tus objetos en memoria con la base de datos
            // muy utilizado en Symfony con Doctrine ORM
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Category[]
     */
    public function findAllOrdered(): array
    {
        // instrucción
        $dql = 'SELECT category FROM App\Entity\Category as category ORDER BY category.name DESC';
        $qb = $this->createQueryBuilder
        $query = $this->getEntityManager()->createQuery($dql);
        return $query->getResult();
    }

    /**
     * @return Category[] Returns an array of Category objects
    */
    public function findByExampleField($value): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOneBySomeField($value): ?Category
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}