<?php

namespace ApiBundle\EventListener;

use ApiBundle\Entity\Invoice;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class InvoiceListener
{
    /**
     * @var $em EntityManager instance of doctrine entity manager
     */
    private $em;

    /**
     * On pre persist entity invoice
     *
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $this->em = $args->getEntityManager();

        $entity = $args->getEntity();

        $this->setCreatedAt($entity);
        $this->setDueDate($entity);
        $this->generateReference($entity);
    }

    /**
     * On pre update entity invoice
     *
     * @param PreUpdateEventArgs $args
     */
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $this->em = $args->getEntityManager();

        /** @var $entity Invoice */
        $entity = $args->getEntity();

        $this->setUpdatedAt($entity);
        $this->setDueDate($entity);
        $this->generateReference($entity);
    }

    /**
     * Generate reference number on persist and update
     *
     * @param $invoice Invoice
     */
    private function generateReference($invoice)
    {
        if (!$invoice instanceof Invoice) {
            return;
        }

        $reference = $invoice->getClient()->getAcronym();
        $reference .= $invoice->getInvoiceDate()->format('Ymd');

        $nbInvoice = $this->em->getRepository('ApiBundle:Invoice')->countFindLikeByReference($reference);
        $nbInvoice++;

        $reference .= ($nbInvoice < 10) ? ('0' . $nbInvoice) : $nbInvoice;

        $invoice->setReference($reference);
    }

    /**
     * Set Due date
     * 30 days after invoiceDate
     *
     * @param $invoice Invoice
     */
    private function setDueDate($invoice)
    {
        if (!$invoice instanceof Invoice) {
            return;
        }

        $invoiceDate = $invoice->getInvoiceDate();
        $dueDate = clone $invoiceDate;
        $dueDate->add(new \DateInterval('P30D'));

        $invoice->setDueDate($dueDate);
    }

    /**
     * Set Created At datetime
     *
     * @param $entity Invoice
     */
    private function setCreatedAt($invoice)
    {
        if (!$invoice instanceof Invoice) {
            return;
        }

        $invoice->setCreatedAt(new \DateTime('now'));
    }

    /**
     * Set Updated At datetime
     *
     * @param $entity Invoice
     */
    private function setUpdatedAt($invoice)
    {
        if (!$invoice instanceof Invoice) {
            return;
        }

        $invoice->setUpdatedAt(new \DateTime('now'));
    }
}