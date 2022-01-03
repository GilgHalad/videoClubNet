<?php

namespace App\DataFixtures;

use App\Entity\Copiesmovies;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class CopiesMoviesFixtures extends Fixture implements OrderedFixtureInterface
{

private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }

    /* USER TEST*/
    public function load(ObjectManager $manager): void
    {
        
        /* ----------- COPIESMOVIES ------------*/

        $copiesMovies = new Copiesmovies();
        $copiesMovies->setRef('RADK0101001');
        $copiesMovies->setidMovie($this->getReference('movie_1'));
        $manager->persist($copiesMovies);
        $this->addReference('id_copieMovie_1',$copiesMovies);
        
        $copiesMovies = new Copiesmovies();
        $copiesMovies->setRef('RADK0102001');
        $copiesMovies->setidMovie($this->getReference('movie_2'));
        $manager->persist($copiesMovies);
        $this->addReference('id_copieMovie_2',$copiesMovies);

        $copiesMovies = new Copiesmovies();
        $copiesMovies->setRef('RADK0103001');
        $copiesMovies->setidMovie($this->getReference('movie_3'));
        $manager->persist($copiesMovies);   
        $this->addReference('id_copieMovie_3',$copiesMovies);     
        
        $manager->flush();
    }

    public function getOrder() {
        return 5;  // Order in which this fixture will be executed
    }
}
