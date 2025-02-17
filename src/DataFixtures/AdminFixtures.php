<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AdminFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('dylanpeix@gmail.com');
        $user->setPassword('$2y$13$2cEEzXimrWh0ueq9In/6TeudC7ZyzA0InLtwWmkJJ5iPYQe3bCwhK');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setBirthday(new \DateTime('1999-01-29'));
        $user->setCreatedAt((new \DateTimeImmutable())); // Date et heure actuelles
        $user->setState(true);

        $manager->persist($user);
        $manager->flush();
    }
}
