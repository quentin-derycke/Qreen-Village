<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Faker\Generator;
use App\Entity\Image;
use App\Entity\Address;
use App\Entity\Product;
use App\Entity\Category;
use App\Entity\Suppliers;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

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


        // *** CATEGORIES IMAGES *** //

        $imgGc = new Image();
        $imgGc->setPath('/images/Categories/Guitare.png')
            ->setAlt('Guitares');
        $manager->persist($imgGc);


        $imgGac = new Image();
        $imgGac->setPath('/images/Categories/Guitare/guitarAcc.png')
            ->setAlt('Guitares Accoustic');
        $manager->persist($imgGac);

        $imgGec = new Image();
        $imgGec->setPath('/images/Categories/Guitare/guitarElec.png')
            ->setAlt('Guitares Elec');
        $manager->persist($imgGec);


        $imgBc = new Image();
        $imgBc->setPath('/images/Categories/Bass.png')
            ->setAlt(' Guitare Basses');
        $manager->persist($imgBc);

        $imgBac = new Image();
        $imgBac->setPath('/images/Categories/Bass/BassAcc.png')
            ->setAlt('Guitares Basses Accoustic');
        $manager->persist($imgBac);

        $imgBec = new Image();
        $imgBec->setPath('/images/Categories/Bass/bassElec.png')
            ->setAlt('Guitares Elec');
        $manager->persist($imgBec);

        $imgDc = new Image();
        $imgDc->setPath('/images/Categories/DJ.png')
            ->setAlt('Materiel DJ');
        $manager->persist($imgDc);

        $imgDrc = new Image();
        $imgDrc->setPath('/images/Categories/Drums.png')
            ->setAlt('Drums');
        $manager->persist($imgDrc);

        $imgKc = new Image();
        $imgKc->setPath('/images/Categories/Piano.png')
            ->setAlt('Piano');
        $manager->persist($imgKc);


        $imgWc = new Image();
        $imgWc->setPath('/images/Categories/Wind.png')
            ->setAlt('Wind');
        $manager->persist($imgWc);

        $imgTc = new Image();
        $imgTc->setPath('/images/Categories/Tradi.png')
            ->setAlt('Tradi');
        $manager->persist($imgTc);

        $imgSc = new Image();
        $imgSc->setPath('/images/Categories/Studio.png')
            ->setAlt('Studio');
        $manager->persist($imgSc);

        $imgMc = new Image();
        $imgMc->setPath('/images/Categories/Micro.png')
            ->setAlt('Micro');
        $manager->persist($imgMc);

        // *** CATEGORIES *** //

        $c1 = new Category();
        $c1->setName("Guitares")
            ->setChilds(null)
            ->setImage($imgGc)
            ->setDescription("Découvrez notre sélection de guitares de qualité à prix imbattables. Du débutant au pro, il y en a pour tous les niveaux et styles. Commandez votre guitare dès maintenant !");
        $manager->persist($c1);

        $c11 = new Category();
        $c11->setName("Guitares Electriques")
            ->setChilds($c1)
            ->setImage($imgGec);
        $manager->persist($c11);

        $c12 = new Category();
        $c12->setName("Guitares accoustiques")
            ->setChilds($c1)
            ->setImage($imgGac);
        $manager->persist($c12);

        $c2 = new Category();
        $c2->setName("Guitares basses")
            ->setChilds(null)
            ->setImage($imgBc);
        $manager->persist($c2);

        $c21 = new Category();
        $c21->setName("Guitares basses accoustiques")
            ->setChilds($c2)
            ->setImage($imgBac);
        $manager->persist($c21);

        $c22 = new Category();
        $c22->setName("Guitares basses électriques")
            ->setChilds($c2)
            ->setImage($imgBec);
        $manager->persist($c22);


        $c3 = new Category();
        $c3->setName("Batteries & Percussions")
            ->setChilds(null)
            ->setImage($imgDrc);
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
            ->setChilds(null)
            ->setImage($imgKc);
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
            ->setChilds(null)
            ->setImage($imgWc);
        $manager->persist($c5);

$c51 = new Category();
$c51->setName('Cuivres')
->setChilds($c5);
$manager->persist($c51);

$c52 = new Category();
$c52->setName('Bois')
->setChilds($c5);
$manager->persist($c52);

$c53 = new Category();
$c53->setName('Ocarina')
->setChilds($c5);
$manager->persist($c53);


        $c6 = new Category();
        $c6->setName("Instruments traditionnels")
            ->setChilds(null)
            ->setImage($imgTc);
        $manager->persist($c6);

        $c61 = new Category();
        $c61->setName("Accordeons")
            ->setChilds($c6);
        $manager->persist($c61);

        $c62 = new Category();
        $c62->setName("Instrumpents de Folklore")
            ->setChilds($c6);
        $manager->persist($c62);

        $c7 = new Category();
        $c7->setName("Matériel DJ")
            ->setChilds(null)
            ->setImage($imgDc);
        $manager->persist($c7);
     
        $c71 = new Category();
        $c71->setName("Logiciel")
            ->setChilds($c7);
        $manager->persist($c71);

        $c8 = new Category();
        $c8->setName("Microphones")
            ->setChilds(null)
            ->setImage($imgMc);
        $manager->persist($c8);
       
       
        $c81 = new Category();
        $c81->setName("Chants")
            ->setChilds($c8);
        $manager->persist($c81);


        $c82 = new Category();
        $c82->setName("Podcast")
            ->setChilds($c8);
        $manager->persist($c82);

        $c9 = new Category();
        $c9->setName("Home Studio")
            ->setChilds(null)
            ->setImage($imgSc);
        $manager->persist($c9);


        $c91 = new Category();
        $c91->setName("Interface Audio")
            ->setChilds($c9);
        $manager->persist($c91);

        // *** IMAGES *** //

        $geimg1 = new Image();
        $geimg1->setPath('/images/Products/Guitare/Electrique/guitare_elec1_1.jpg')
            ->setAlt('guitelec1');
        $manager->persist($geimg1);

        $geimg2 = new Image();
        $geimg2->setPath('/images/Products/Guitare/Electrique/GuitareElec0_0.jpg')
            ->setAlt('guitelec2');
        $manager->persist($geimg2);
        
        
        $ge1img1 = new Image();
        $ge1img1->setPath('/images/Products/Guitare/Electrique/guitarElec0_1.jpg')
            ->setAlt('guitelec3');
        $manager->persist($ge1img1);
        
        $ge1img2 = new Image();
        $ge1img2->setPath('/images/Products/Guitare/Electrique/GuitareElec0_2.jpg')
            ->setAlt('guitelec4');
        $manager->persist($ge1img2);

        
        $gaimg1 = new Image();
        $gaimg1->setPath('/images/Products/Guitare/accoustic/accoustic0_0.jpg')
            ->setAlt('guitacc0');
        $manager->persist($gaimg1);

        $gaimg2 = new Image();
        $gaimg2->setPath('/images/Products/Guitare/accoustic/accoustic0_1.jpg')
            ->setAlt('guitacc1');
        $manager->persist($gaimg2);

        $bimg1 = new Image();
        $bimg1->setPath('/images/Products/Basse/accoustic/baccoustic0_0.jpg')
        ->setAlt('baccoustic0');
        $manager->persist($bimg1);
        
        $bimg2 = new Image();
        $bimg2->setPath('/images/Products/Basse/electric/belectric0_0.jpg')
        ->setAlt('belectric0');
        $manager->persist($bimg2);

// ** SUPPLIERS ** //

$s1 = new Suppliers();
$s1->setName('Fender');
$manager->persist($s1);

$s2 = new Suppliers();
$s2->setName('Gibson');
$manager->persist($s2);

$s3 = new Suppliers();
$s3->setName('Cort');
$manager->persist($s3);

$s4 = new Suppliers();
$s4->setName('Epiphone');
$manager->persist($s4);


        // *** PRODUCTS *** //

        $productGe = new Product();
        $productGe->setName(' Electric Eye')
            ->setCategoryId($c11)
            ->setPrice(mt_rand(25, 2750))
            ->setDescription(mt_rand(0, 10) . ' chance(s) sur 10 de devenir sourd')
            ->setReference(uniqid('G-V__'))
            ->setDiscount('0')
            ->addImage($geimg1)
            ->addImage($geimg2)
            ->setSupplier($s1)
            ->setStock(mt_rand(1, 100));

        $manager->persist($productGe);

        for ($i = 0; $i < 15; $i++) {
            $product = new Product();
            $product->setName('Elec ' . $i)
                ->setCategoryId($c11)
                ->setPrice(mt_rand(25, 2750))
                ->setDescription(mt_rand(0, 10) . ' chance(s) sur 10 de devenir sourd')
                ->setReference(uniqid('G-V__'))
                ->setDiscount('0')
                ->addImage($ge1img1)
            ->addImage($ge1img2)
            ->setSupplier($s2)
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
                ->addImage($gaimg1)
                ->setSupplier($s3)
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
                ->addImage($bimg1)
                ->setSupplier($s1)
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
                ->addImage($bimg1)
                ->setSupplier($s4)
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

        for ($i = 0; $i < 10; $i++) {
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
