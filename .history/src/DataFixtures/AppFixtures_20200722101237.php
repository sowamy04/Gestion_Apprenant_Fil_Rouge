<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $profil = new Profil();
        $profil->setLibelle('ROLE_APPRENANT');
        $manager->persist($profil);
        $profil = new Profil();
        $profil->setLibelle('ROLE_CM');
        $manager->persist($profil);
        $profil = new Profil();
        $profil->setLibelle('ROLE_ADMIN');
        $manager->persist($profil);
        $profil = new Profil();
        $profil->setLibelle('ROLE_ENCADREUR');
        $manager->persist($profil);


        $manager->flush();
    }
}