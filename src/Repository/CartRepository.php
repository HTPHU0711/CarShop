<?php

namespace App\Repository;

use App\Entity\Cart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cart>
 *
 * @method Cart|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cart|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cart[]    findAll()
 * @method Cart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cart::class);
    }

    public function save(Cart $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Cart $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    /**
    * @return Cart[] Returns an array of Cart objects
    */
    public function cartshow($value): array
    {
        return $this->createQueryBuilder('c')
         ->select('c.id cid, p.name , c.quantity, p.price, p.image')
             ->innerJoin('c.procart','p')
             ->innerJoin('c.uscart','u')
            ->where('u.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getArrayResult()
        ;
    }
    public function checkQuantity($proId, $cartId): array
    {
        return $this->createQueryBuilder('c')
            ->select('Count(c.id) as count, c.quantity as quantity, c.id as id')
            ->innerJoin('c.product', 'p')
            ->innerJoin('c.cart', 'ca')
            ->andWhere('p.id = :proId')
            ->setParameter('proId', $proId)
            ->andWhere('ca.id = :cartId')
            ->setParameter('cartId', $cartId)
            ->getQuery()
            ->getResult();
    }
    public function getProductID($value): array
    {
        return $this->createQueryBuilder('cd')
            ->select('p.id as product, p.price as price, (p.price * cd.quantity) as total, cd.quantity as quantity')
            ->innerJoin('cd.product', 'p')
            ->innerJoin('cd.cart', 'c')
            ->where('cd.cart = :id')
            ->setParameter('id',$value)
            ->getQuery()
            ->getResult()
        ;
    }

//    /**
//     * @return Cart[] Returns an array of Cart objects
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

//    public function findOneBySomeField($value): ?Cart
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
