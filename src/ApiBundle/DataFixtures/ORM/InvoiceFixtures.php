<?php
namespace AppBundle\DataFixtures\ORM;

use ApiBundle\DataFixtures\ORM\ClientFixtures;
use ApiBundle\Entity\Invoice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class InvoiceFixtures extends Fixture
{
    /**
     * Load fixtures Invoice
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $invoice1 = new Invoice();
        $invoice1->setReference('GLF20171010');
        $invoice1->setInvoiceDate(new \DateTime('now'));
        $invoice1->setCreatedAt(new \DateTime('now'));
        $invoice1->setDueDate(new \DateTime('now+30'));
        $invoice1->setObject('Mission en régie, 60 jours');
        $invoice1->setTerms('Paiement dans les 30 jours à compter de la date de facturation');
        $invoice1->setFooter('SIRET 939829020939889392003 N°TVA 093802984098390');
        $invoice1->setClient($this->getReference('client-gougueul'));
        $invoice1->setStatus($this->getReference('status-draft'));
        $manager->persist($invoice1);
        $this->setReference('invoice01', $invoice1);

        $invoice2 = new Invoice();
        $invoice2->setReference('GLF20170801');
        $invoice2->setInvoiceDate(new \DateTime('now-60'));
        $invoice2->setCreatedAt(new \DateTime('now'));
        $invoice2->setDueDate(new \DateTime('now-30'));
        $invoice2->setObject('Mission en régie, 30 jours');
        $invoice2->setTerms('Paiement dans les 30 jours à compter de la date de facturation');
        $invoice2->setFooter('SIRET 939829020939889392003 N°TVA 093802984098390');
        $invoice2->setClient($this->getReference('client-gougueul'));
        $invoice2->setStatus($this->getReference('status-paid'));
        $manager->persist($invoice2);
        $this->setReference('invoice02', $invoice2);


        $invoice3 = new Invoice();
        $invoice3->setReference('APL20171010');
        $invoice3->setInvoiceDate(new \DateTime('now'));
        $invoice3->setCreatedAt(new \DateTime('now'));
        $invoice3->setObject('Développement App Mobile');
        $invoice3->setTerms('Paiement dans les 30 jours à compter de la date de facturation');
        $invoice3->setFooter('SIRET 939829020939889392003 N°TVA 093802984098390');
        $invoice3->setClient($this->getReference('client-apeul'));
        $invoice3->setStatus($this->getReference('status-sent'));
        $manager->persist($invoice3);
        $this->setReference('invoice03', $invoice3);

        $invoice4 = new Invoice();
        $invoice4->setReference('APL20170910');
        $invoice4->setInvoiceDate(new \DateTime('now'));
        $invoice4->setCreatedAt(new \DateTime('now'));
        $invoice4->setObject('Développement App Mobile');
        $invoice4->setTerms('Paiement dans les 30 jours à compter de la date de facturation');
        $invoice4->setFooter('SIRET 939829020939889392003 N°TVA 093802984098390');
        $invoice4->setClient($this->getReference('client-apeul'));
        $invoice4->setStatus($this->getReference('status-accepted'));
        $manager->persist($invoice4);
        $this->setReference('invoice04', $invoice4);

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
            ClientFixtures::class,
            InvoiceStatusFixtures::class
        ];
    }
}
