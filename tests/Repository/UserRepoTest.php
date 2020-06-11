<?php

namespace App\Tests\Repository;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
class UserRepoTest extends KernelTestCase
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }
    public function testUserByEmail(): void
    {
        $user = $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['email' => 'test17891@test.com'])
        ;
        $this->assertSame('test17891@test.com', $user->getEmail());
    }

    public function testUserAll(): void
    {
        $user = $this->entityManager
            ->getRepository(User::class)
            ->findAll();
        $this->assertSame(gettype(new User()), gettype($user[0]));
    }
}
