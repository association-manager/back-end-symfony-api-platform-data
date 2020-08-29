<?php

namespace App\Tests\Repository;

use App\Entity\ProductWebsite;

class ProductWebsiteRepoTest extends BaseKernelTestCase
{

    public function testProductWebsiteAll(): void
    {
        $productWebsite = $this->entityManager
            ->getRepository(ProductWebsite::class)
            ->findAll();
        $this->assertSame(gettype(new ProductWebsite()), gettype($productWebsite[0]));
    }
}
