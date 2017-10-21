<?php
namespace ApiBundle\DataFixtures\ORM;

use ApiBundle\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ClientFixtures extends Fixture
{
    /**
     * Load fixtures Client
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $c1 = new Client();
        $c1->setName('Gougueul');
        $c1->setAcronym('GGL');
        $c1->setEmail('patron@google.com');
        $c1->setAddress('Montain View, CA');
        $c1->setUrlWebsite('https://google.com');
        $c1->setContactFirstName('Larry');
        $c1->setContactLastName('Page');

        $manager->persist($c1);
        $this->addReference('client-gougueul', $c1);

        $c2 = new Client();
        $c2->setName('Apeul');
        $c2->setAcronym('APL');
        $c2->setEmail('patron@apeul.com');
        $c2->setAddress('Cupertino, CA');
        $c2->setUrlWebsite('https://apple.com');
        $c2->setContactFirstName('Steve');
        $c2->setContactLastName('Job');

        $manager->persist($c2);
        $this->addReference('client-apeul', $c2);

        $manager->flush();
    }
}
