<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InvoiceStatus
 *
 * @ORM\Table(name="invoice_status")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\InvoiceStatusRepository")
 */
class InvoiceStatus
{
    /**
     * @const string
     */
    const STATE_DRAFT = "draft";

    /**
     * @const string
     */
    const STATE_SENT = "sent";

    /**
     * @const string
     */
    const STATE_ACCEPTED = "accepted";

    /**
     * @const string
     */
    const STATE_REFUSED = "refused";

    /**
     * @const string
     */
    const STATE_TO_PAY = "topay";

    /**
     * @const string
     */
    const STATE_PAID = "paid";

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=20, unique=true, columnDefinition="ENUM('draft', 'sent', 'accepted', 'refused', 'topay', 'paid')")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\Invoice", mappedBy="status")
     */
    private $invoices;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->invoices = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return InvoiceStatus
     */
    public function setName($name)
    {
        if (!in_array($name,
            [
                self::STATE_DRAFT,
                self::STATE_SENT,
                self::STATE_ACCEPTED,
                self::STATE_REFUSED,
                self::STATE_TO_PAY,
                self::STATE_PAID
            ])
        ) {
            throw new \InvalidArgumentException("Invalid invoice status");
        }

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return InvoiceStatus
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add invoice
     *
     * @param \ApiBundle\Entity\Invoice $invoice
     *
     * @return InvoiceStatus
     */
    public function addInvoice(\ApiBundle\Entity\Invoice $invoice)
    {
        $this->invoices[] = $invoice;

        return $this;
    }

    /**
     * Remove invoice
     *
     * @param \ApiBundle\Entity\Invoice $invoice
     */
    public function removeInvoice(\ApiBundle\Entity\Invoice $invoice)
    {
        $this->invoices->removeElement($invoice);
    }

    /**
     * Get invoices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInvoices()
    {
        return $this->invoices;
    }
}
