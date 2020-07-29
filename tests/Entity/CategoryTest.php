<?php

namespace App\Tests\Entity;

use App\Entity\Category;
use App\Entity\Planning;
use App\Entity\Transaction;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function testCategory(): void
    {
        $category = new Category();
        $planning = new Planning();
        $transaction = new Transaction();
        $category->setName('name')
            ->setType('type')
            ->addTransaction($transaction)
            ->addPlanning($planning)
        ;

        $this->getResultOfPrivateProperty( Category::class, 'id', $category, 1);
        $this->assertEquals(1, $category->getId());
        $this->assertEquals('name', $category->getName());
        $this->assertEquals('type', $category->getType());
        $this->assertEquals(gettype(new Planning()), gettype($category->getPlannings()));
        $this->assertEquals(gettype(new Transaction()), gettype($category->getTransactions()));

       $category->removeTransaction($transaction)
        ->removePlanning($planning);
    }

    /**
     * @param string $class
     * @param string $propertyName
     * @param object $newClass
     * @param int|null $value
     * @return \ReflectionProperty
     * @throws \ReflectionException
     */
    protected function getResultOfPrivateProperty(
        string $class,
        string $propertyName,
        object $newClass,
        ?int $value
    ): \ReflectionProperty {
        $reflection = new \ReflectionClass($class);
        $method = $reflection->getProperty($propertyName);
        $method->setAccessible(true);
        $method->setValue($newClass, $value);
        return $method;
    }

}
