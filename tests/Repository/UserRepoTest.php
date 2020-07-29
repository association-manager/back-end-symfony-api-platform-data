<?php

namespace App\Tests\Repository;

use App\Entity\User;

class UserRepoTest extends BaseKernelTestCase
{
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
