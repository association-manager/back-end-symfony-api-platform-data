<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class AdminAdService {
    private $manager;

    public function __construct(EntityManagerInterface $manager) {
        $this->manager = $manager;
    }

    public function getAllUserWhereAdIsNotNull() {
        return $this->manager->createQuery('SELECT u FROM App\Entity\User u LEFT JOIN u.advertisements a WHERE a.id IS NOT NULL')->getResult();
    }

    public function getAllCategoriesWhereSubTypeIsNotNull() {
        return $this->manager->createQuery('SELECT c FROM App\Entity\Category c WHERE c.subType IS NOT NULL')->getResult();
    }

}