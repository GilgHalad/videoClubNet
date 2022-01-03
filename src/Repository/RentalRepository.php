<?php
// /src/Repository/RentalRepository.php
namespace App\Repository;

use App\Entity\Rental;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Rental|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rental|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rental[]    findAll()
 * @method Rental[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Rental[]    findRentalDistinct($user)

 * RentalDistinct
 */
class RentalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rental::class);
    }

    public function findByRentalDistinct($user)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT r.ref,mv.name
                FROM videoclub.rental r
                INNER JOIN videoclub.copiesmovies cm on cm.id = r.id_copie_movie
                INNER JOIN videoclub.movies mv on mv.id = cm.id_movie
                where r.id_state=3 '//and r.id_user='.$user'
            )
            ->getResult();
    }



    // /**
    //  * @return Rental[] Returns an array of Rental objects
    //  */
    /*
    public function findByExampleField($value)
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
    */

    /*
    public function findOneBySomeField($value): ?Rental
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}