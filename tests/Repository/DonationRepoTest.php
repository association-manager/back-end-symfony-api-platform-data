<?php

namespace App\Tests\Repository;

use App\Entity\Donation;

class DonationRepoTest extends BaseKernelTestCase
{

    public function testDonationAll(): void
    {
        $donation = $this->entityManager
            ->getRepository(Donation::class)
            ->findAll();
        $this->assertSame(gettype(new Donation()), gettype($donation[0]));
    }
}
