<?php

namespace App\Tests\Repository;

use App\Entity\AssoManagerEvent;

class AssoManagerEventRepoTest extends BaseKernelTestCase
{

    public function testAssoManagerEventAll(): void
    {
        $assoManagerEvent = $this->entityManager
            ->getRepository(AssoManagerEvent::class)
            ->findAll();
        $this->assertSame(gettype(new AssoManagerEvent()), gettype($assoManagerEvent[0]));
    }
}
