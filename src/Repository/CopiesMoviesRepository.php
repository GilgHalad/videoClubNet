<?php
// /src/Repository/CopiesMoviesRepository.php
namespace App\Repository;

use App\Entity\CopiesMovies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CopiesMovies|null find($id, $lockMode = null, $lockVersion = null)
 * @method CopiesMovies|null findOneBy(array $criteria, array $orderBy = null)
 * @method CopiesMovies[]    findAll()
 * @method CopiesMovies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CopiesMoviesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CopiesMovies::class);
    }

    public function findByIdMovie()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT c.name , max(c.cont) 
                FROM (SELECT count(a.id) cont,b.name
                FROM videoclub.copiesmovies a
                inner join videoclub.movies b on a.id_movie = b.id 
                group by id_movie) as c'
            )
            ->getResult();
    }
    
}