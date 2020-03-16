<?php
namespace App\DataFixtures;

use App\Entity\Trajet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TrajetFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     *
     * @return vo
     */
    public function load(ObjectManager $manager) : void
    {
        $trajet1 = new Trajet();

        $option = ['animaux','Gros Bagage'];

        $trajet1->setConducteur($manager->merge($this->getReference('user-fred')))
        ->setPointDepart($manager->merge($this->getReference('destination-lorient')))
        ->setPointArrivee($manager->merge($this->getReference('destination-caen')))
        ->setTempsTrajet(60)
        ->setPrix(14.5)
        ->setNbPlaces(3)
        ->setVehicule('Clio')
        ->setOptions($option);
        $manager->persist($trajet1);

        $trajet2 = new Trajet();

        $option = ['climatisation','Gros Bagage'];

        $trajet2->setConducteur($manager->merge($this->getReference('user-karine')))
        ->setPointDepart($manager->merge($this->getReference('destination-caen')))
        ->setPointArrivee($manager->merge($this->getReference('destination-lorient')))
        ->setTempsTrajet(220)
        ->setPrix(36.9)
        ->setNbPlaces(4)
        ->setVehicule('3006')
        ->setOptions($option);
        $manager->persist($trajet2);

        $trajet3 = new Trajet();

        $option = [''];

        $trajet3->setConducteur($manager->merge($this->getReference('user-avignon')))
        ->setPointDepart($manager->merge($this->getReference('destination-brest')))
        ->setPointArrivee($manager->merge($this->getReference('destination-saint-mich')))
        ->setTempsTrajet(90)
        ->setPrix(20.9)
        ->setNbPlaces(2)
        ->setVehicule('Laguna')
        ->setOptions($option);
        $manager->persist($trajet3);

        $manager->flush();

        $this->addReference('trajet-fred-lorient-caen', $trajet1);
        $this->addReference('trajet-karine-caen-lorient', $trajet2);
        $this->addReference('trajet-avignon-brest-saint-mich', $trajet3);
    }
    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            DestinationFixtures::class,
        ];
    }

}
?>