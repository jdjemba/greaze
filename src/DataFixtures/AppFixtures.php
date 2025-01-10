<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private PasswordHasherFactoryInterface $passwordHasherFactory,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = new User();
        $user->setEmail('user@eemi.com');
        $user->setRoles([User::ROLE_USER]);
        $user->setPassword($this->passwordHasherFactory->getPasswordHasher(User::class)->hash('user'));
        $manager->persist($user);

        $user = new User();
        $user->setEmail('admin@eemi.com');
        $user->setRoles([User::ROLE_ADMIN]);
        $user->setPassword($this->passwordHasherFactory->getPasswordHasher(User::class)->hash('admin'));
        $manager->persist($user);

        $user = new User();
        $user->setEmail('banned@eemi.com');
        $user->setRoles([User::ROLE_BANNED]);
        $user->setPassword($this->passwordHasherFactory->getPasswordHasher(User::class)->hash('banned'));
        $manager->persist($user);

        $manager->flush();
    }
}
