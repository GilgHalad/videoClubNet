<?php

namespace App\DataFixtures;

use App\Entity\Movies;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class MoviesFixtures extends Fixture implements OrderedFixtureInterface
{

private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }

    /* USER TEST*/
    public function load(ObjectManager $manager): void
    {

        /* ----------- MOVIES ------------*/

        $movies = new Movies();
        $movies->setName('Blade Runner');
        $movies->setPoster('bladeRunner_poster');
        $movies->setIdGenre($this->getReference('genre_SCI'));
        $manager->persist($movies);
        $this->addReference('movie_1',$movies);

        $movies = new Movies();
        $movies->setName('Matrix');
        $movies->setPoster('matrix_poster');
        $movies->setIdGenre($this->getReference('genre_SCI'));
        $manager->persist($movies);
        $this->addReference('movie_2',$movies);

        $movies = new Movies();
        $movies->setName('Othello');
        $movies->setPoster('othello_poster');
        $movies->setIdGenre($this->getReference('genre_drama'));
        $manager->persist($movies);
        $this->addReference('movie_3',$movies);

        $movies = new Movies();
        $movies->setName('Apache');
        $movies->setIdGenre($this->getReference('genre_western'));
        $manager->persist($movies);   
        $this->addReference('movie_4',$movies);     
       
        $manager->flush();
    }

    public function getOrder() {
        return 4;  // Order in which this fixture will be executed
    }
}
