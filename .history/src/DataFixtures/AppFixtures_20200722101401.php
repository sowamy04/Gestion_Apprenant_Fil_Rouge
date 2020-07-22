<?php

namespace App\DataFixtures;

use App\Entity\Profil;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $profil1 = new Profil();
        $profil1->setLibelle('ROLE_APPRENANT');
        $manager->persist($profil1);
        $profil2 = new Profil();
        $profil2->setLibelle('ROLE_CM');
        $manager->persist($profil2);
        $profil3 = new Profil();
        $profil3->setLibelle('ROLE_ADMIN');
        $manager->persist($profil3);
        $profil4 = new Profil();
        $profil4->setLibelle('ROLE_ENCADREUR');
        $manager->persist($profil4);


        $manager->flush();
    }
}