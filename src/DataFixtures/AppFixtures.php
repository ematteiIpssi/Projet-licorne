<?php

namespace App\DataFixtures;

use App\Entity\Choix;
use App\Entity\Scenario;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $choix = new Choix();
        $choix->setNom('test choix');
        $manager->persist($choix);

        $choix->setDescription('testtestestes');

        $scenario = new Scenario();
        $scenario->setNom('test');
        $scenario->addIdChoix($choix);
        $scenario->setPalier(1);
        
        $manager->persist($scenario);
        $manager->flush();
    }
}
