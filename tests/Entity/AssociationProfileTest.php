<?php

namespace App\Tests\Entity;

use App\Entity\Address;
use App\Entity\Association;
use App\Entity\AssociationProfile;
use App\Entity\InvoiceDonation;
use App\Entity\InvoiceShop;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class AssociationProfileTest extends TestCase
{
    public function testAssociationProfile(): void
    {
        $associationProfile = new AssociationProfile();
        $association = new Association();
        $associationProfile->setTitle('title')
        ->setDescription('description')
        ->setAssociation($association)
        ->setDescriptionTitle('title');

        $this->getResultOfPrivateProperty( AssociationProfile::class, 'id', $associationProfile, 1);
        $this->assertEquals("title", $associationProfile->getTitle());
        $this->assertEquals("title", $associationProfile->getDescriptionTitle());
        $this->assertEquals("description", $associationProfile->getDescription());
        $this->assertEquals(1, $associationProfile->getId());
        $this->assertEquals(gettype(new Association()), gettype($associationProfile->getAssociation()));

   ;

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
