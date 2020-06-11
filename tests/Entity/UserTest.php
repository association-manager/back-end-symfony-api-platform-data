<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUser(): void
    {
        $user = new User();
        $user->setFirstName('firstName')
            ->setEmail('test@test.com')
            ->setLastName('LastName')
        ;

        $this->assertEquals('firstName', $user->getFirstName());
        $this->assertEquals('test@test.com', $user->getEmail());
        $this->assertEquals('LastName', $user->getLastName());
    }

}
