<?php

namespace App\Tests\Repository;

use App\Entity\Announce;

class AnnounceRepoTest extends BaseKernelTestCase
{

    public function testAnnounceAll(): void
    {
        $announce = $this->entityManager
            ->getRepository(Announce::class)
            ->findAll();
        $this->assertSame(gettype(new Announce()), gettype($announce[0]));
    }
}
