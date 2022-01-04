<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class UserFixtures extends Fixture implements OrderedFixtureInterface
{

private $encoder;

    public function __construct( UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }

    /* USER TEST*/
    public function load(ObjectManager $manager): void
    {

        /* --------- USERS -----------*/

        $user = new User();
        $user->setEmail('user@prueba.com');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->encoder->encodePassword($user,'123'));
        $user->setName('Luis');
        $user->setLastName1('Perez');
        $user->setLastName2('Gonzalez');
        $user->setPhone(667123456);
        $manager->persist($user);
        $this->addReference('user',$user);

        $user = new User();
        $user->setEmail('admin@prueba.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->encoder->encodePassword($user,'123'));
        $user->setName('Luisa');
        $user->setLastName1('Martin');
        $user->setLastName2('Gutierrez');
        $user->setPhone(667789123);
        $manager->persist($user);      
        $this->addReference('admin',$user);

        $manager->flush();
    }

    public function getOrder() {
        return 3;  // Order in which this fixture will be executed
    }
}
