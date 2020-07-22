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


        $user = new User();
        $user->setEmail('moussa@gmail.com')
            ->setRoles(['ROLE_ENCADREUR'])
            ->setPassword(
                $this->encoder->encodePassword($user, 'moussa1234')
            );
        $manager->persist($user);
        $user = new User();
        $user->setEmail('amy@gmail.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword(
                $this->encoder->encodePassword($user, 'amy1234')
            );
        $manager->persist($user);
        $user = new User();
        $user->setEmail('thierno@gmail.com')
            ->setRoles(['ROLE_CM'])
            ->setPassword(
                $this->encoder->encodePassword($user, 'thierno1234')
            );
        $manager->persist($user);
        $user = new User();
        $user->setEmail('assane@gmail.com')
            ->setRoles(['ROLE_APPRENANT'])
            ->setPassword(
                $this->encoder->encodePassword($user, 'assane1234')
            );
        $manager->persist($user);

        $manager->flush();
    }
}