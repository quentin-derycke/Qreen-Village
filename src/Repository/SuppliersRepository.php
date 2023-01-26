<?php

namespace App\Repository;

use App\Entity\Suppliers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Suppliers>
 *
 * @method Suppliers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Suppliers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Suppliers[]    findAll()
 * @method Suppliers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuppliersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Suppliers::class);
    }

    public function save(Suppliers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Suppliers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findBySupplier($supplier)
    {

        return $this->createQueryBuilder('s')
            ->select("s.name, SUM(p.price * oi.quantity) as total")
            ->join('s.products', 'p')
            ->join('p.items', 'oi')
            ->join('oi.orderRef', 'o')
            ->andWhere('s.name LIKE :name')
            ->andWhere('o.status LIKE :status')
            ->setParameter('name', $supplier)
            ->setParameter('status', 'proccess')
            ->groupBy('s.name')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Suppliers[] Returns an array of Suppliers objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Suppliers
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
