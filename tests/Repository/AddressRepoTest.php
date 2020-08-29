<?php

namespace App\Tests\Repository;

use App\Entity\Address;

class AddressRepoTest extends BaseKernelTestCase
{

    public function testAddressAll(): void
    {
        $address = $this->entityManager
            ->getRepository(Address::class)
            ->findAll();
        $this->assertSame(gettype(new Address()), gettype($address[0]));
    }
}
