<?php

namespace App\Repository;

use App\Entity\Animator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Animator>
 */
class AnimatorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Animator::class);
    }

    //    /**
    //     * @return Animator[] Returns an array of Animator objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Animator
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function search(string $search) {

        return $this->createQueryBuilder('a') // On crée un queryBuilder pour l'entité Animator
        ->where('a.firstname LIKE :search') // Clause pour titre
        ->orWhere('a.lastname LIKE :search') // Clause pour content
        ->setParameter('search', '%'.$search.'%') // Paramètre de recherche ici, avant et après
        ->getQuery()
            ->getResult();

        // SELECT * FORM article AS a WHERE a.title LIKE '%search%' OR WHERE a.content LIKE '%search%'
    }
}
