<?php
namespace App\DataFixtures;

use App\Entity\Reservation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ReservationFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void
    {
        $resa1 = new Reservation();
       
        $resa1->setTrajet($manager->merge($this->getReference('trajet-fred-lorient-caen')))
        ->setPassager($manager->merge($this->getReference('user-gervaise')))
        ->setPaye(true)
        ->setNbPersonnes('2');
        $manager->persist($resa1);

        $resa2 = new Reservation();
       
        $resa2->setTrajet($manager->merge($this->getReference('trajet-fred-lorient-caen')))
        ->setPassager($manager->merge($this->getReference('user-karine')))
        ->setPaye(false)
        ->setNbPersonnes('1');
        $manager->persist($resa1);

        $resa3 = new Reservation();
       
        $resa3->setTrajet($manager->merge($this->getReference('trajet-avignon-brest-saint-mich')))
        ->setPassager($manager->merge($this->getReference('user-fred')))
        ->setPaye(true)
        ->setNbPersonnes('2');
        $manager->persist($resa3);

        $resa4 = new Reservation();
       
        $resa4->setTrajet($manager->merge($this->getReference('trajet-karine-caen-lorient')))
        ->setPassager($manager->merge($this->getReference('user-fred')))
        ->setPaye(true)
        ->setNbPersonnes('4');
        $manager->persist($resa4);
       
        $manager->flush();
    }
    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            TrajetFixtures::class,
        ];
    }

}
?>