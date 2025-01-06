<?php

namespace App\Repository;

use App\Entity\CategorieParent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @extends ServiceEntityRepository<CategorieParent>
 *
 * @method CategorieParent|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieParent|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieParent[]    findAll()
 * @method CategorieParent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieParentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieParent::class);
    }

    public function findAllWithCategories(): array
{
    return $this->createQueryBuilder('cp')
        ->leftJoin('cp.lescategories', 'c')
        ->addSelect('c')
        ->getQuery()
        ->getResult();
}

public function findAllWithCategoriesParParent($id): array
{
    return $this->createQueryBuilder('cp')
        ->leftJoin('cp.lescategories', 'c')
        ->addSelect('c')
        ->where('cp.id = :id') // Ajout de la condition pour filtrer par l'ID de la catégorie parent
        ->setParameter('id', $id) // Définition de la valeur du paramètre ':id' à la valeur de $id passée à la méthode
        ->getQuery()
        ->getResult();
}




//    /**
//     * @return CategorieParent[] Returns an array of CategorieParent objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CategorieParent
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
