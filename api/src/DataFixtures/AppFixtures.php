<?php

namespace App\DataFixtures;

use App\Entity\Blog;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public const ADMIN_USER_REFERENCE = 'admin-user';
    private EntityManagerInterface $entityManager;
    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->entityManager = $entityManager;
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setEmail('admin@admin.com');
        $userAdmin->setPassword($this->userPasswordHasher->hashPassword($userAdmin,'hero123456789'));
        $userAdmin->setRoles(['ROLE_USER']);
        $this->entityManager->persist($userAdmin);

        $blog = new Blog();
        $blog->setTitle('This is title');
        $blog->setBody('This is body');
        $this->entityManager->persist($blog);

        $this->entityManager->flush();

    }
}
