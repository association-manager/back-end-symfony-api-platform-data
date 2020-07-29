<?php

namespace App\Tests\Repository;

use App\Entity\InvoiceDonation;

class InvoiceDonationRepoTest extends BaseKernelTestCase
{

    public function testInvoiceDonationAll(): void
    {
        $invoiceDonation = $this->entityManager
            ->getRepository(InvoiceDonation::class)
            ->findAll();
        $this->assertSame(gettype(new InvoiceDonation()), gettype($invoiceDonation[0]));
    }
}
