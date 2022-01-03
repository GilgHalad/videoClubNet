<?php

namespace App\DataFixtures;

use App\Entity\State;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class StateFixtures extends Fixture implements OrderedFixtureInterface
{

private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }

    /* USER TEST*/
    public function load(ObjectManager $manager): void
    {

        /* ----------- STATES ------------*/

        $state = new State();
        $state->setName('rented');
        $manager->persist($state);
        $this->addReference('state_rental',$state);

        $state = new State();
        $state->setName('unrented');
        $manager->persist($state);
        $this->addReference('state_unrental',$state);

        $state = new State();
        $state->setName('finish');
        $manager->persist($state);

        $manager->flush();
    }

    public function getOrder() {
        return 2;  // Order in which this fixture will be executed
    }
}
