<?php
namespace App\DataFixtures;

use App\Entity\Commentaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use \DateTime;

class CommentaireFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     *
     * @return vo
     */
    public function load(ObjectManager $manager) : void
    {
        $Com1 = new Commentaire();
        $Com1->setPosteur($manager->merge($this->getReference('user-fred')))
        ->setTrajet($manager->merge($this->getReference('trajet-avignon-brest-saint-mich')))
        ->setMessage('Cété tro bi1 jé grave kiffé')
        ->setNote('5')
        ->setDatePost(new DateTime(date('Y-m-d h:i:s')));
        $manager->persist($Com1);

        $Com2 = new Commentaire();
       
        $Com2->setPosteur($manager->merge($this->getReference('user-karine')))
        ->setTrajet($manager->merge($this->getReference('trajet-fred-lorient-caen')))
        ->setMessage('Trajet fort sympathique, compagnie agréable')
        ->setNote('4')
        ->setDatePost(new DateTime(date('Y-m-d h:i:s')));
        $manager->persist($Com2);

        $Com3 = new Commentaire();
       
        $Com3->setPosteur($manager->merge($this->getReference('user-gervaise')))
        ->setTrajet($manager->merge($this->getReference('trajet-fred-lorient-caen')))
        ->setMessage('A vomi sur le siège avant.')
        ->setNote('1')
        ->setDatePost(new DateTime(date('Y-m-d h:i:s')));
        $manager->persist($Com3);

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