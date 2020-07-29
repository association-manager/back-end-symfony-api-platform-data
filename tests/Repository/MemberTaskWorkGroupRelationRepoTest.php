<?php

namespace App\Tests\Repository;

use App\Entity\MemberTaskWorkGroupRelation;

class MemberTaskWorkGroupRelationRepoTest extends BaseKernelTestCase
{

    public function testMemberTaskWorkGroupRelationAll(): void
    {
        $memberTaskWorkGroupRelation = $this->entityManager
            ->getRepository(MemberTaskWorkGroupRelation::class)
            ->findAll();
        $this->assertSame(gettype(new MemberTaskWorkGroupRelation()), gettype($memberTaskWorkGroupRelation[0]));
    }
}
