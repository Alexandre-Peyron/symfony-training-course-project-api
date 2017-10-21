<?php
namespace AppBundle\DataFixtures\ORM;

use ApiBundle\Entity\Invoice;
use ApiBundle\Entity\InvoiceLine;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class InvoiceLinesFixtures extends Fixture
{
    /**
     * Load fixtures InvoiceLine
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /** @var $invoice1 Invoice */
        $invoice1 = $this->getReference('invoice01');

        $l1 = new InvoiceLine();
        $l1->setInvoice($invoice1);
        $l1->setDesignation('Développement en régie');
        $l1->setSign(InvoiceLine::SIGN_POSITIVE);
        $l1->setQuantity(60);
        $l1->setAmount(600);
        $l1->setUnit('Jour');
        $l1->setTax(20);
        $manager->persist($l1);

        /** @var $invoice2 Invoice */
        $invoice2 = $this->getReference('invoice02');

        $l2 = new InvoiceLine();
        $l2->setInvoice($invoice2);
        $l2->setDesignation('Développement en régie');
        $l2->setSign(InvoiceLine::SIGN_POSITIVE);
        $l2->setQuantity(30);
        $l2->setAmount(500);
        $l2->setUnit('Jour');
        $l2->setTax(20);
        $manager->persist($l2);

        $l3 = new InvoiceLine();
        $l3->setInvoice($invoice2);
        $l3->setDesignation('Remise commerciale');
        $l3->setSign(InvoiceLine::SIGN_NEGATIVE);
        $l3->setQuantity(1);
        $l3->setAmount(500);
        $l3->setUnit('');
        $l3->setTax(0);
        $manager->persist($l3);

        /** @var $invoice3 Invoice */
        $invoice3 = $this->getReference('invoice03');

        $l4 = new InvoiceLine();
        $l4->setInvoice($invoice3);
        $l4->setDesignation('Développment API Symfony 3');
        $l4->setSign(InvoiceLine::SIGN_POSITIVE);
        $l4->setQuantity(15);
        $l4->setAmount(600);
        $l4->setUnit('Jour');
        $l4->setTax(20);
        $manager->persist($l4);

        $l5 = new InvoiceLine();
        $l5->setInvoice($invoice3);
        $l5->setDesignation('Développment React Native');
        $l5->setSign(InvoiceLine::SIGN_POSITIVE);
        $l5->setQuantity(30);
        $l5->setAmount(800);
        $l5->setUnit('Jour');
        $l5->setTax(20);
        $manager->persist($l5);

        $l6 = new InvoiceLine();
        $l6->setInvoice($invoice3);
        $l6->setDesignation('Retours et debug');
        $l6->setSign(InvoiceLine::SIGN_POSITIVE);
        $l6->setQuantity(15);
        $l6->setAmount(600);
        $l6->setUnit('Jour');
        $l6->setTax(20);
        $manager->persist($l6);

        /** @var $invoice4 Invoice */
        $invoice4 = $this->getReference('invoice04');

        $l7 = new InvoiceLine();
        $l7->setInvoice($invoice4);
        $l7->setDesignation('Développement Angular Ionic');
        $l7->setSign(InvoiceLine::SIGN_POSITIVE);
        $l7->setQuantity(21);
        $l7->setAmount(600);
        $l7->setUnit('Jour');
        $l7->setTax(20);
        $manager->persist($l7);

        $l8 = new InvoiceLine();
        $l8->setInvoice($invoice4);
        $l8->setDesignation('Recette');
        $l8->setSign(InvoiceLine::SIGN_POSITIVE);
        $l8->setQuantity(7);
        $l8->setAmount(600);
        $l8->setUnit('Jour');
        $l8->setTax(20);
        $manager->persist($l8);

        $l9 = new InvoiceLine();
        $l9->setInvoice($invoice4);
        $l9->setDesignation('iPone X pour test et debug');
        $l9->setSign(InvoiceLine::SIGN_POSITIVE);
        $l9->setQuantity(1);
        $l9->setAmount(1200);
        $l9->setUnit('');
        $l9->setTax(0);
        $manager->persist($l9);

        $manager->flush();
    }

    /**
     * Set fixtures dependencies
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            InvoiceFixtures::class
        ];
    }
}
