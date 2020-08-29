<?php

namespace App\Tests\Repository;

use App\Entity\InvoiceShop;

class InvoiceShopRepoTest extends BaseKernelTestCase
{

    public function testInvoiceShopAll(): void
    {
        $invoiceShop = $this->entityManager
            ->getRepository(InvoiceShop::class)
            ->findAll();
        $this->assertSame(gettype(new InvoiceShop()), gettype($invoiceShop[0]));
    }
}
