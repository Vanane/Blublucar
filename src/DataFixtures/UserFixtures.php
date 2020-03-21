<?php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
        
    }

    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void
    {
        $user1 = new User();
       
        $role = ['ROLE_USER'];

        $user1->setEmail('fred@TF1.fr')
        ->setRoles($role)
        ->setPassword($this->passwordEncoder->encodePassword($user1, 'azerty'));
        $manager->persist($user1);

        $user2 = new User();
       
        $role = ['ROLE_USER'];

        $user2->setEmail('karine@lebert.com')
        ->setRoles($role)
        ->setPassword($this->passwordEncoder->encodePassword($user2, 'azerty'));
        $manager->persist($user2);

        $user3 = new User();
       
        $role = ['ROLE_USER'];

        $user3->setEmail('Gervaise@Lamartine.com')
        ->setRoles($role)
        ->setPassword($this->passwordEncoder->encodePassword($user3, 'gervaise'));
        $manager->persist($user3);

        $user4 = new User();
       
        $role = ['Passager'];

        $user4->setEmail('Avignon@Dupont.com')
        ->setRoles($role)
        ->setPassword($this->passwordEncoder->encodePassword($user4, 'blbl'));
        $manager->persist($user4);

        $user5 = new User();
       
        $role = ['ROLE_USER'];

        $user5->setEmail('Jeanne@Eleou.fr')
        ->setRoles($role)
        ->setPassword($this->passwordEncoder->encodePassword($user5, '456789'));
        $manager->persist($user5);

        $user6 = new User();
       
        $role = ['ROLE_ADMIN', 'ROLE_USER'];

        $user6->setEmail('admin@admin.admin')
        ->setRoles($role)
        ->setPassword($this->passwordEncoder->encodePassword($user6, 'admin'));
        $manager->persist($user6);
        
        $manager->flush();

        $this->addReference('user-fred', $user1);
        $this->addReference('user-karine', $user2);
        $this->addReference('user-gervaise', $user3);
        $this->addReference('user-avignon', $user4);
        $this->addReference('user-jeanne', $user5);
        $this->addReference('user-admin', $user6);
    }
    

}
?>