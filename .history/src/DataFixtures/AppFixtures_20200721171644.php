<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
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
        // $product = new Product();
        // $manager->persist($product);
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