<?php

namespace App\DataFixtures;

use App\Entity\Adress;
use App\Entity\Category;
use App\Entity\NFT;
use App\Entity\NFTPurchase;
use App\Entity\PriceInfos;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();

        $adress = new Adress();
        $adress->setRoad("1 rue des Tilleuls")
            ->setPostalCode("69007")
            ->setCity("Lyon");
        $manager->persist($adress);

        $client = new User();
        $client->setUsername("Max")
            ->setPassword("test")
            ->setRoles(["ROLE_USER"])
            ->setMail("max@test.com")
            ->setGender(1)
            ->setFirstname("Maxence")
            ->setLastname("Leduc")
            ->setBirthDate(new DateTime("01/31/1997"))
            ->setAdress($adress);
        $manager->persist($client);

        $category = new Category();
        $category->setName("NBA")
            ->setDescription("NBA basketball courts");
        $manager->persist($category);

        $priceInfos = new PriceInfos();
        $priceInfos->setDate(new DateTime())
            ->setEthPrice(2);
        $manager->persist($priceInfos);

        $nft = new NFT();
        $nft->setImg("test")
            ->setName("Toronto Raptors Court")
            ->setDescription("NBA Toronto Raptors team's court, in Toronto (Canada)")
            ->setCity("Toronto")
            ->setCountry("Canada")
            ->setDropDate(new DateTime("02/02/2023"))
            ->addCategory($category)
            ->addPriceInfo($priceInfos);
        $manager->persist($nft);

        $purchase = new NFTPurchase();
        $purchase->setDate(new DateTime())
            ->setEthPurchasePrice(2.23)
            ->setEurPurchasePrice(3831.87)
            ->setUser($client)
            ->setNft($nft);
        $manager->persist($purchase);

        $manager->flush();
    }
}
