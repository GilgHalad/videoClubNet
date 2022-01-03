<?php

namespace App\DataFixtures;

use App\Entity\Genre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class GenreFixtures extends Fixture implements OrderedFixtureInterface
{

private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }

    /* USER TEST*/
    public function load(ObjectManager $manager): void
    {
        /* ----------- GENRE ------------*/

        $genre = new Genre();
        $genre->setName('SCI');
        $manager->persist($genre);
        $this->addReference('genre_SCI',$genre);

        $genre = new Genre();
        $genre->setName('Drama');
        $manager->persist($genre);
        $this->addReference('genre_drama',$genre);

        $genre = new Genre();
        $genre->setName('Western');
        $manager->persist($genre);
        $this->addReference('genre_western',$genre);

        $manager->flush();
    }

    public function getOrder() {
        return 1;  // Order in which this fixture will be executed
    }
}
