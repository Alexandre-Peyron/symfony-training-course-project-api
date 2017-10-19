<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InvoiceLine
 *
 * @ORM\Table(name="invoice_line")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\InvoiceLineRepository")
 */
class InvoiceLine
{
    /**
     * @const string
     */
    const SIGN_POSITIVE = 'positive';

    /**
     * @const string
     */
    const SIGN_NEGATIVE = 'negative';

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
     * @ORM\Column(name="designation", type="string", length=255)
     */
    private $designation;

    /**
     * @var string
     *
     * @ORM\Column(name="quantity", type="float", nullable=true)
     */
    private $quantity = 1;

    /**
     * @var string
     *
     * @ORM\Column(name="unit", type="string", length=20, nullable=true)
     */
    private $unit;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;

    /**
     * @var float
     *
     * @ORM\Column(name="tax", type="float", nullable=true)
     */
    private $tax;

    /**
     * @var string
     *
     * @ORM\Column(name="sign", type="string", length=20, columnDefinition="ENUM('positive', 'negative')")
     */
    private $sign;

    /**
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Invoice", inversedBy="lines", cascade={"persist"})
     * @ORM\JoinColumn(name="invoice_id", referencedColumnName="id", nullable=false)
     */
    private $invoice;

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
     * Set amount
     *
     * @param float $amount
     *
     * @return InvoiceLine
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set tax
     *
     * @param float $tax
     *
     * @return InvoiceLine
     */
    public function setTax($tax)
    {
        $this->tax = $tax;

        return $this;
    }

    /**
     * Get tax
     *
     * @return float
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * Set sign
     *
     * @param string $sign
     *
     * @return InvoiceLine
     */
    public function setSign($sign)
    {
        if (!in_array($sign, array(self::SIGN_POSITIVE, self::SIGN_NEGATIVE))) {
            throw new \InvalidArgumentException("Invalid sign");
        }
        $this->sign = $sign;

        return $this;
    }

    /**
     * Get sign
     *
     * @return string
     */
    public function getSign()
    {
        return $this->sign;
    }

    /**
     * Set invoice
     *
     * @param \ApiBundle\Entity\Invoice $invoice
     *
     * @return InvoiceLine
     */
    public function setInvoice(\ApiBundle\Entity\Invoice $invoice)
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * Get invoice
     *
     * @return \ApiBundle\Entity\Invoice
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * Set designation
     *
     * @param string $designation
     *
     * @return InvoiceLine
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set quantity
     *
     * @param float $quantity
     *
     * @return InvoiceLine
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return float
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set unit
     *
     * @param string $unit
     *
     * @return InvoiceLine
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }
}
