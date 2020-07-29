<?php

namespace App\Tests\Repository;

use App\Entity\NetworksSocialLink;

class NetworksSocialLinkRepoTest extends BaseKernelTestCase
{

    public function testNetworksSocialLinkAll(): void
    {
        $networksSocialLink = $this->entityManager
            ->getRepository(NetworksSocialLink::class)
            ->findAll();
        $this->assertSame(gettype(new NetworksSocialLink()), gettype($networksSocialLink[0]));
    }
}
