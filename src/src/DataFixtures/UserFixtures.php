<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserFixtures extends Fixture
{
    function __construct(EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher) {
        $this->em = $em;
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setPassword($this->passwordHasher->hashPassword($user,'123'));
        $user->setEmail('miles.lcoleman@gmail.com');
        $user->setRoles(['ROLE_ADMIN','ROLE_USER']);
        $this->em->persist($user);
        $this->em->flush();
    }
}
