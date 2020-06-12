<?php

namespace App\Tests\Entity;

use App\Entity\Address;
use App\Entity\User;
use PHPUnit\Framework\TestCase;
use DateTime;

class UserTest extends TestCase
{
    public function testUser(): void
    {
        $user = new User();
        $userAddress = new Address();
        $userAddress->setAddressLine1('AddressLine1')
            ->setPostalCode('PostalCode')
            ->setCity('City')
            ->setCountry('Country')
            ->setType('Type');

        $user->setFirstName('firstName')
            ->setLastName('LastName')
            ->setEmail('test@test.com')
            ->setMobile('+336023156325')
            ->setSex('male')
            ->setPassword('password')
            ->setDataUsageAgreement(0)
            ->setDob(new DateTime())
            ->addAddress($userAddress);

        $this->assertEquals('firstName', $user->getFirstName());
        $this->assertEquals('test@test.com', $user->getEmail());
        $this->assertEquals('LastName', $user->getLastName());
        $this->assertEquals('+336023156325', $user->getMobile());
        $this->assertEquals('male', $user->getSex());
        $this->assertEquals(gettype(new DateTime()), gettype($user->getCreatedAt()));
        $this->assertEquals(gettype(new DateTime()), gettype($user->getDob()));
        $this->assertEquals('password', $user->getPassword());
        $this->assertEquals(0, $user->getDataUsageAgreement());
        $this->assertEquals(gettype(new Address()), gettype($user->getAddress()));
    }

}
