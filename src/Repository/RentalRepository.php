<?php
// /src/Repository/RentalRepository.php
namespace App\Repository;

use App\Entity\Rental;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
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

    public function findAllGroupByIdCopieMovie($idUser)
    {   

     /*    $query = $this->createQueryBuilder('e')
       // ->addSelect('e')
        ->innerJoin('e.idCopieMovie', 'r') 
        ->addSelect('r')
        ->select('r')
        ->where('e.idUser = :parameter') 
        ->andWhere('e.idState = 3')
        ->setParameter('parameter', $idUser)
        ->getQuery();
        return $query->getResult();
*/
        $query = $this->createQueryBuilder('r')
        ->select(['r'])
         ->where('r.idUser = :parameter') 
         ->andWhere('r.idState = 3')
         ->setParameter('parameter', $idUser)
         ->getQuery();
         return $query->getResult();

/*
        return $this->getEntityManager()
            ->createQuery(
                'SELECT DISTINCT cm , r , mv
                FROM App:Rental r
                INNER JOIN App:copiesmovies cm WITH cm.id = r.idCopieMovie
                INNER JOIN App:Movies mv WITH mv.id = cm.idMovie
                where r.idState=3'
                 'SELECT r
                  FROM App:Rental r
                  where r.idState=3'
            )
            ->getResult();
            ///            ->createQuery('SELECT p FROM AcmeStoreBundle:Product p ORDER BY p.name ASC')
            */  }

    

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