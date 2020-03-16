<?php
namespace App\DataFixtures;

use App\Entity\Destination;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class DestinationFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void
    {
        $destination1 = new Destination();
       
        $destination1->setNom('Longvic')
        ->setLatitude('47,2852')
        ->setLongitude('5,0611');
        $manager->persist($destination1);

        $destination2 = new Destination();
       
        $destination2->setNom('Saint-Michel-chef-chef')
        ->setLatitude('47,1823')
        ->setLongitude('-2,148');
        $manager->persist($destination2);


        $destination3 = new Destination();
       
        $destination3->setNom('Caen')
        ->setLatitude('49,1829')
        ->setLongitude('-,3707');
        $manager->persist($destination3);

        $destination4 = new Destination();
       
        $destination4->setNom('Brest')
        ->setLatitude('44,4655')
        ->setLongitude('5,1287');
        $manager->persist($destination4);

        $destination5 = new Destination();
       
        $destination5->setNom('Lorient')
        ->setLatitude('47,7483')
        ->setLongitude('-3,3702');
        $manager->persist($destination5);

        $manager->flush();

        $this->addReference('destination-longvic', $destination1);
        $this->addReference('destination-saint-mich', $destination2);
        $this->addReference('destination-caen', $destination3);
        $this->addReference('destination-brest', $destination4);
        $this->addReference('destination-lorient', $destination5);
    }
}