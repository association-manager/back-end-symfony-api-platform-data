<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;

class StatsService {
    private $manager;

    public function __construct(EntityManagerInterface $manager) {
        $this->manager = $manager;
    }

    public function getStats() {
        $advertisers      = $this->getUsersAdvertisersCount();
        $advertisements        = $this->getAdvertisementsCount();
        $categories   = $this->getCategoriesCount();

        return compact('advertisers', 'advertisements', 'categories');
    }

    public function getUsersAdvertisersCount() {
        return $this->manager->createQuery('SELECT COUNT(DISTINCT a.user) AS adv FROM App\Entity\Advertisement a')->getSingleScalarResult();
    }

    public function getAdvertisementsCount() {
        return $this->manager->createQuery('SELECT COUNT(a) FROM App\Entity\Advertisement a')->getSingleScalarResult();
    }

    public function getCategoriesCount() {
        return $this->manager->createQuery('SELECT COUNT(c) FROM App\Entity\Category c WHERE c.subType IS NOT NULL')->getSingleScalarResult();
    }

}