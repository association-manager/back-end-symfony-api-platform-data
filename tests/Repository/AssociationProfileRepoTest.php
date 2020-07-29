<?php

namespace App\Tests\Repository;

use App\Entity\AssociationProfile;

class AssociationProfileRepoTest extends BaseKernelTestCase
{

    public function testAssociationProfileAll(): void
    {
        $associationProfile = $this->entityManager
            ->getRepository(AssociationProfile::class)
            ->findAll();
        $this->assertSame(gettype(new AssociationProfile()), gettype($associationProfile[0]));
    }
}
