<?php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void
    {
        $user1 = new User();
       
        $role = ['Conducteur','Passager'];

        $user1->setEmail('fred@TF1.fr')
        ->setRoles($role)
        ->setPassword('123456');
        $manager->persist($user1);

        $user2 = new User();
       
        $role = ['Conducteur'];

        $user2->setEmail('karine@lebert.com')
        ->setRoles($role)
        ->setPassword('azerty');
        $manager->persist($user2);

        $user3 = new User();
       
        $role = ['Passager'];

        $user3->setEmail('Gervaise@Lamartine.com')
        ->setRoles($role)
        ->setPassword('gervaise');
        $manager->persist($user3);

        $user4 = new User();
       
        $role = ['Passager'];

        $user4->setEmail('Avignon@Dupont.com')
        ->setRoles($role)
        ->setPassword('blbl');
        $manager->persist($user4);

        $user5 = new User();
       
        $role = ['Conducteur','Passager'];

        $user5->setEmail('Jeanne@Eleou.fr')
        ->setRoles($role)
        ->setPassword('456789');
        $manager->persist($user5);


        $manager->flush();

        $this->addReference('user-fred', $user1);
        $this->addReference('user-karine', $user2);
        $this->addReference('user-gervaise', $user3);
        $this->addReference('user-avignon', $user4);
        $this->addReference('user-jeanne', $user5);
    }
    

}
?>