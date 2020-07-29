<?php

namespace App\Tests\Repository;

use App\Entity\Transaction;

class TransactionRepoTest extends BaseKernelTestCase
{

    public function testTransactionAll(): void
    {
        $transaction = $this->entityManager
            ->getRepository(Transaction::class)
            ->findAll();
        $this->assertSame(gettype(new Transaction()), gettype($transaction[0]));
    }
}
