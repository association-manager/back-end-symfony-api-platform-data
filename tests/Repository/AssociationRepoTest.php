<?php

namespace App\Tests\Repository;

use App\Entity\Association;

class AssociationRepoTest extends BaseKernelTestCase
{

    public function testAssociationAll(): void
    {
        $association = $this->entityManager
            ->getRepository(Association::class)
            ->findAll();
        $this->assertSame(gettype(new Association()), gettype($association[0]));
    }
}
