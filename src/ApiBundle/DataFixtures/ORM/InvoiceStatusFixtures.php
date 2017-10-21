<?php

namespace AppBundle\DataFixtures\ORM;

use ApiBundle\Entity\InvoiceStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class InvoiceStatusFixtures extends Fixture
{
    /**
     * Load Fixtures InvoiceStatus
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $s1 = new InvoiceStatus();
        $s1->setName(InvoiceStatus::STATE_DRAFT);
        $s1->setDescription('Devis en mode brouillon');
        $manager->persist($s1);
        $this->addReference('status-draft', $s1);


        $s2 = new InvoiceStatus();
        $s2->setName(InvoiceStatus::STATE_SENT);
        $s2->setDescription('Devis envoyé au client');
        $manager->persist($s2);
        $this->addReference('status-sent', $s2);

        $s3 = new InvoiceStatus();
        $s3->setName(InvoiceStatus::STATE_ACCEPTED);
        $s3->setDescription('Devis accepté par le client');
        $manager->persist($s3);
        $this->addReference('status-accepted', $s3);

        $s4 = new InvoiceStatus();
        $s4->setName(InvoiceStatus::STATE_REFUSED);
        $s4->setDescription('Devis refusé par le client');
        $manager->persist($s4);
        $this->addReference('status-refused', $s4);

        $s5 = new InvoiceStatus();
        $s5->setName(InvoiceStatus::STATE_TO_PAY);
        $s5->setDescription('Facture à payer par le client');
        $manager->persist($s5);
        $this->addReference('status-topay', $s5);

        $s6 = new InvoiceStatus();
        $s6->setName(InvoiceStatus::STATE_PAID);
        $s6->setDescription('Facture payée');
        $manager->persist($s6);
        $this->addReference('status-paid', $s6);

        $manager->flush();
    }
}
