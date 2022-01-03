<?php

namespace App\DataFixtures;

use App\Entity\Rental;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class RentalsFixtures extends Fixture implements OrderedFixtureInterface
{

private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }

    /* USER TEST*/
    public function load(ObjectManager $manager): void
    {  

        /* ----------- RENTAL ------------*/

        $rental = new Rental();
        $rental->setIdUser($this->getReference('user'));
        $rental->setIdCopieMovie($this->getReference('id_copieMovie_1'));
        $rental->setIdState($this->getReference('state_rental'));
        $rental->setRentalAt(new \DateTime('2021-12-01 13:12:36'));
        $manager->persist($rental);

        $rental = new Rental();
        $rental->setIdUser($this->getReference('user'));
        $rental->setIdCopieMovie($this->getReference('id_copieMovie_2'));
        $rental->setIdState($this->getReference('state_unrental'));
        $rental->setRentalAt(new \DateTime('2021-12-01 13:12:36'));
        $rental->setReturnAt(new \DateTime('2021-12-03 13:12:36'));
        $manager->persist($rental);

        $rental = new Rental();
        $rental->setIdUser($this->getReference('admin'));
        $rental->setIdCopieMovie($this->getReference('id_copieMovie_3'));
        $rental->setIdState($this->getReference('state_rental'));
        $rental->setRentalAt(new \DateTime('2021-12-01 13:12:36'));
        $manager->persist($rental);
        $manager->flush();

        $manager->persist($rental);
        $manager->flush();
    }

    public function getOrder() {
        return 6;  // Order in which this fixture will be executed
    }
}
