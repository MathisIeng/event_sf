<?php

namespace App\Repository;

use App\Entity\Establishment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Establishment>
 */
class EstablishmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Establishment::class);
    }

    //    /**
    //     * @return Establishment[] Returns an array of Establishment objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Establishment
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function search(string $search) {

        return $this->createQueryBuilder('e') // On crée un queryBuilder pour l'entité Animator
        ->where('e.name LIKE :search') // Clause pour titre
        ->setParameter('search', '%'.$search.'%') // Paramètre de recherche ici, avant et après
        ->getQuery()
            ->getResult();

        // SELECT * FORM article AS a WHERE a.title LIKE '%search%' OR WHERE a.content LIKE '%search%'
    }
}
