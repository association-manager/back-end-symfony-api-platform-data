<?php

namespace App\Tests\Repository;

use App\Entity\Member;

class MemberRepoTest extends BaseKernelTestCase
{

    public function testMemberAll(): void
    {
        $member = $this->entityManager
            ->getRepository(Member::class)
            ->findAll();
        $this->assertSame(gettype(new Member()), gettype($member[0]));
    }
}
