<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $hash = $this->encoder->encodePassword($user, "admin");

        $user->setPassword($hash)
            ->setEmail("freelance@crm.com")
            ->setFirstName("freelance")
            ->setRoles(["ROLE_USER", "ROLE_FREELANCE"])
            ->setLastName("freelance");

        $manager->persist($user);
        $manager->flush();

        $this->addReference('userAdmin', $user);
    }
}
