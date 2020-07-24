<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Profil;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $profils = ["ADMIN", "FORMATEUR", "APPRENANT", "CM"];
        foreach ($profils as $key => $libelle) {
            $profil = new Profil();
            $profil->setLibelle($libelle);
            $manager->persist($profil);
            $manager->flush();
            for ($i = 1; $i <= 3; $i++) {
                $user = new User();
                $user->setProfil($profil);
                $user->setEmail(strtolower($libelle) . $i . '@gmail.com');
                $user->setPrenom($faker->name());
                $user->setNom($faker->name());
                $user->setAdresse($faker->address);
                //Génération des Users
                $password = $this->encoder->encodePassword($user, 'pass1234');
                $user->setPassword($password);

                $manager->persist($user);
            }

            $manager->flush();
        }
    }
}