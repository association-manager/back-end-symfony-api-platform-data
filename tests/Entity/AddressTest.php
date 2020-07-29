<?php

namespace App\Tests\Entity;

use App\Entity\Address;
use App\Entity\Association;
use App\Entity\InvoiceDonation;
use App\Entity\InvoiceShop;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
{
    public function testAddressToGetAssociationName(): void
    {
        $address = new Address();
        $association = new Association();
        $association->setName('name');
        $address->setAddressLine1('AddressLine1')
            ->setPostalCode('12345')
            ->setCity('City')
            ->setAssociation($association)
            ->setCountry('Country')
            ->setType('Type');

        $this->getResultOfPrivateProperty( Address::class, 'id', $address, 1);
        $this->assertEquals("name", $address->getOwnerAddres());
        $this->assertEquals(1, $address->getId());
        $this->assertEquals('City', $address->getCity());
        $this->assertEquals('Country', $address->getCountry());
        $this->assertEquals('12345', $address->getPostalCode());
        $this->assertEquals('Type', $address->getType());
   ;

    }

    public function testAddress(): void
    {
        $user = new User();
        $user->setFirstName('firstName')
            ->setLastName('LastName');
        $address = new Address();
        $association = new Association();
        $association->setName('name');
        $invoiceDonation = new InvoiceDonation();
        $invoiceShop = new InvoiceShop();
        $address->setAddressLine1('AddressLine1')
            ->setAddressLine2('AddressLine2')
            ->setPostalCode('12345')
            ->setCity('City')
            ->setUser($user)
            ->setAssociation($association)
            ->setCountry('Country')
            ->setType('Type')
            ->setInvoiceShop($invoiceShop)
            ->setInvoiceDonation($invoiceDonation);



        $this->getResultOfPrivateProperty( Address::class, 'id', $address, 1);
        $this->assertEquals("firstName LastName", $address->getOwnerAddres());
        $this->assertEquals(1, $address->getId());
        $this->assertEquals('AddressLine1', $address->getAddressLine1());
        $this->assertEquals('AddressLine2', $address->getAddressLine2());
        $this->assertEquals('City', $address->getCity());
        $this->assertEquals('Country', $address->getCountry());
        $this->assertEquals('12345', $address->getPostalCode());
        $this->assertEquals('Type', $address->getType());
        $this->assertEquals(gettype(new Association()), gettype($address->getAssociation()));
        $this->assertEquals(gettype(new InvoiceDonation()), gettype($address->getInvoiceDonation()));
        $this->assertEquals(gettype(new InvoiceShop()), gettype($address->getInvoiceShop()));
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
