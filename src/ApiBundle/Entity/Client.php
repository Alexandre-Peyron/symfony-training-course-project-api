<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\ClientRepository")
 */
class Client
{
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="acronym", type="string", length=5, unique=true)
     */
    private $acronym;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_first_name", type="string", length=100)
     */
    private $contactFirstName;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_last_name", type="string", length=100)
     */
    private $contactLastName;

    /**
     * @var string
     *
     * @ORM\Column(name="url_website", type="string", length=255, nullable=true)
     */
    private $urlWebsite;

    /**
     * @var string
     *
     * @ORM\Column(name="url_facebook", type="string", length=255, nullable=true)
     */
    private $urlFacebook;

    /**
     * @var string
     *
     * @ORM\Column(name="url_linkedin", type="string", length=255, nullable=true)
     */
    private $urlLinkedin;

    /**
     * @var string
     *
     * @ORM\Column(name="url_twitter", type="string", length=255, nullable=true)
     */
    private $urlTwitter;


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
     * @return Client
     */
    public function setName($name)
    {
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
     * Set acronym
     *
     * @param string $acronym
     *
     * @return Client
     */
    public function setAcronym($acronym)
    {
        $this->acronym = $acronym;

        return $this;
    }

    /**
     * Get acronym
     *
     * @return string
     */
    public function getAcronym()
    {
        return $this->acronym;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Client
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Client
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set contactFirstName
     *
     * @param string $contactFirstName
     *
     * @return Client
     */
    public function setContactFirstName($contactFirstName)
    {
        $this->contactFirstName = $contactFirstName;

        return $this;
    }

    /**
     * Get contactFirstName
     *
     * @return string
     */
    public function getContactFirstName()
    {
        return $this->contactFirstName;
    }

    /**
     * Set contactLastName
     *
     * @param string $contactLastName
     *
     * @return Client
     */
    public function setContactLastName($contactLastName)
    {
        $this->contactLastName = $contactLastName;

        return $this;
    }

    /**
     * Get contactLastName
     *
     * @return string
     */
    public function getContactLastName()
    {
        return $this->contactLastName;
    }

    /**
     * Set urlWebsite
     *
     * @param string $urlWebsite
     *
     * @return Client
     */
    public function setUrlWebsite($urlWebsite)
    {
        $this->urlWebsite = $urlWebsite;

        return $this;
    }

    /**
     * Get urlWebsite
     *
     * @return string
     */
    public function getUrlWebsite()
    {
        return $this->urlWebsite;
    }

    /**
     * Set urlFacebook
     *
     * @param string $urlFacebook
     *
     * @return Client
     */
    public function setUrlFacebook($urlFacebook)
    {
        $this->urlFacebook = $urlFacebook;

        return $this;
    }

    /**
     * Get urlFacebook
     *
     * @return string
     */
    public function getUrlFacebook()
    {
        return $this->urlFacebook;
    }

    /**
     * Set urlLinkedin
     *
     * @param string $urlLinkedin
     *
     * @return Client
     */
    public function setUrlLinkedin($urlLinkedin)
    {
        $this->urlLinkedin = $urlLinkedin;

        return $this;
    }

    /**
     * Get urlLinkedin
     *
     * @return string
     */
    public function getUrlLinkedin()
    {
        return $this->urlLinkedin;
    }

    /**
     * Set urlTwitter
     *
     * @param string $urlTwitter
     *
     * @return Client
     */
    public function setUrlTwitter($urlTwitter)
    {
        $this->urlTwitter = $urlTwitter;

        return $this;
    }

    /**
     * Get urlTwitter
     *
     * @return string
     */
    public function getUrlTwitter()
    {
        return $this->urlTwitter;
    }
}

