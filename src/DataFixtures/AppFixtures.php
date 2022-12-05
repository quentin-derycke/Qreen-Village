<?php

namespace App\DataFixtures;

use App\Entity\Address;
use Faker\Factory;
use App\Entity\User;
use Faker\Generator;
use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    /**
     * @var Generator
     *
     * @var Generator
     */
    private Generator $faker;


    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
    {

        // *** CATEGORIES *** //

        $c1 = new Category();
        $c1->setName("Guitares")
            ->setChilds(null);
        $manager->persist($c1);

        $c11 = new Category();
        $c11->setName("Guitares Electriques")
            ->setChilds($c1);
        $manager->persist($c11);

        $c12 = new Category();
        $c12->setName("Guitares accoustiques")
            ->setChilds($c1);
        $manager->persist($c12);

        $c2 = new Category();
        $c2->setName("Guitares basses")
            ->setChilds(null);
        $manager->persist($c2);

        $c21 = new Category();
        $c21->setName("Guitares basses accoustiques")
            ->setChilds($c2);
        $manager->persist($c21);

        $c22 = new Category();
        $c22->setName("Guitares basses électriques")
            ->setChilds($c2);
        $manager->persist($c22);


        $c3 = new Category();
        $c3->setName("Batteries & Percussions")
            ->setChilds(null);
        $manager->persist($c3);

        $c31 = new Category();
        $c31->setName("Batteries")
            ->setChilds($c3);
        $manager->persist($c31);

        $c32 = new Category();
        $c32->setName("Percussions")
            ->setChilds($c3);
        $manager->persist($c32);

        $c4 = new Category();
        $c4->setName("Pianos & Claviers")
            ->setChilds(null);
        $manager->persist($c4);

        $c41 = new Category();
        $c41->setName("Claviers")
            ->setChilds($c4);
        $manager->persist($c41);


        $c42 = new Category();
        $c42->setName("Pianos")
            ->setChilds($c4);
        $manager->persist($c42);

        $c5 = new Category();
        $c5->setName("Instruments à vent")
            ->setChilds(null);
        $manager->persist($c5);

        $c6 = new Category();
        $c6->setName("Instruments traditionnels")
            ->setChilds(null);
        $manager->persist($c6);

        $c7 = new Category();
        $c7->setName("Matériel DJ")
            ->setChilds(null);
        $manager->persist($c7);

        $c8 = new Category();
        $c8->setName("Microphones")
            ->setChilds(null);
        $manager->persist($c8);

        $c9 = new Category();
        $c9->setName("Sonorisation")
            ->setChilds(null);
        $manager->persist($c9);




        // *** PRODUCTS *** //

        for ($i = 0; $i < 30; $i++) {
            $product = new Product();
            $product->setName('Elec ' . $i)
                ->setCategoryId($c11)
                ->setPrice(mt_rand(25, 2750))
                ->setDescription(mt_rand(0, 10) . ' chance(s) sur 10 de devenir sourd')
                ->setReference(uniqid('G-V__'))
                ->setDiscount('0')
                ->setStock(mt_rand(1, 100));
            $manager->persist($product);
        }

        for ($i = 0; $i < 15; $i++) {
            $product = new Product();
            $product->setName('Accoustique ' . $i)
                ->setCategoryId($c12)
                ->setPrice(mt_rand(25, 2750))
                ->setDescription(mt_rand(0, 10) . ' chance(s) sur 10 de devenir sourd')
                ->setReference(uniqid('G-V__'))
                ->setDiscount('0')
                ->setStock(mt_rand(1, 100));
            $manager->persist($product);
        }

        for ($i = 0; $i < 25; $i++) {
            $product = new Product();
            $product->setName('Basse accoustique ' . $i)
                ->setCategoryId($c21)
                ->setPrice(mt_rand(25, 2750))
                ->setDescription(mt_rand(0, 10) . ' chance(s) sur 10 de devenir sourd')
                ->setReference(uniqid('G-V__'))
                ->setDiscount('0')
                ->setStock(mt_rand(1, 100));
            $manager->persist($product);
        }

        for ($i = 0; $i < 35; $i++) {
            $product = new Product();
            $product->setName('Basse ' . $i)
                ->setCategoryId($c22)
                ->setPrice(mt_rand(25, 2750))
                ->setDescription(mt_rand(0, 10) . ' chance(s) sur 10 de devenir sourd')
                ->setReference(uniqid('G-V__'))
                ->setDiscount('0')
                ->setStock(mt_rand(1, 100));
            $manager->persist($product);
        }

        // ***  USERS  *** //
        $users = [];
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setName($this->faker->name())
                ->setLastname($this->faker->name())
                ->setBirthdate($this->faker->dateTime())
                ->setPhoneNumber($this->faker->e164PhoneNumber())
                ->setEmail($this->faker->email())
                ->setRoles(['ROLE_USER'])
                ->setPlainpassword('password');
                $users[] = $user;
            $manager->persist($user);
        }

        // *** ADDRESS *** // 

        for($i = 0; $i < 10; $i++){
             $address = new Address();
             $address->setHouseNumber($this->faker->buildingNumber())
                    ->setStreet($this->faker->streetName())
                    ->setCity($this->faker->city())
                    ->setZipcode($this->faker->buildingNumber())
                    ->setUser($users[mt_rand(0, count($users) - 1)]);
                    $manager->persist($address);
        }

        $manager->flush();
    }
}
