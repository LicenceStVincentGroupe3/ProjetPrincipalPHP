<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\OperationFormRepository")
 */
class OperationForm
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @OneToOne(targetEntity="Operations", mappedBy="operationForm")
     * @JoinColumn(name="operations", referencedColumnName="operation_code")
     */
    protected $operations;

    /**
     * @ORM\Column(type="integer")
     */
    private $contactsSexe;

    /**
     * @ORM\Column(type="integer")
     */
    private $contactsFirstname;

    /**
     * @ORM\Column(type="integer")
     */
    private $contactsName;

    /**
     * @ORM\Column(type="integer")
     */
    private $contactsBirthday;

    /**
     * @ORM\Column(type="integer")
     */
    private $contactsMailPro;

    /**
     * @ORM\Column(type="integer")
     */
    private $contactsPhone;

    /**
     * @ORM\Column(type="integer")
     */
    private $contactsMobilePhone;

    /**
     * @ORM\Column(type="integer")
     */
    private $contactsLinkedinAddress;

    /**
     * @ORM\Column(type="integer")
     */
    private $contactsTwitterAddress;

    /**
     * @ORM\Column(type="integer")
     */
    private $contactsFacebookAddress;

    /**
     * @ORM\Column(type="integer")
     */
    private $contactsJob;

    /**
     * @ORM\Column(type="integer")
     */
    private $contactsPoste;

    /**
     * @ORM\Column(type="integer")
     */
    private $companyName;

    /**
     * @ORM\Column(type="integer")
     */
    private $companyNaf;

    /**
     * @ORM\Column(type="integer")
     */
    private $companyLegalStatus;

    /**
     * @ORM\Column(type="integer")
     */
    private $companySiret;

    /**
     * @ORM\Column(type="integer")
     */
    private $companyNbEmployees;

    /**
     * @ORM\Column(type="integer")
     */
    private $companyTurnovers;

    /**
     * @ORM\Column(type="integer")
     */
    private $companyAddress;

    /**
     * @ORM\Column(type="integer")
     */
    private $companyPostalCode;

    /**
     * @ORM\Column(type="integer")
     */
    private $companyCountry;

    /**
     * @ORM\Column(type="integer")
     */
    private $companyStandardPhone;

    /**
     * @ORM\Column(type="integer")
     */
    private $companyFax;

    /**
     * @ORM\Column(type="integer")
     */
    private $companyWebsite;

    /**
     * @ORM\Column(type="integer")
     */
    private $companyEmail;

    public function getId()
    {
        return $this->id;
    }


    public function getCompanyEmail()
    {
        return $this->companyEmail;
    }

    public function setCompanyEmail($companyEmail): self
    {
        $this->companyEmail = $companyEmail;

        return $this;
    }

    public function getCompanyWebsite()
    {
        return $this->companyWebsite;
    }

    public function setCompanyWebsite($companyWebsite): self
    {
        $this->companyWebsite = $companyWebsite;

        return $this;
    }

    public function getCompanyFax()
    {
        return $this->companyFax;
    }

    public function setCompanyFax($companyFax): self
    {
        $this->companyFax = $companyFax;

        return $this;
    }

    public function getCompanyStandardPhone()
    {
        return $this->companyStandardPhone;
    }

    public function setCompanyStandardPhone($companyStandardPhone): self
    {
        $this->companyStandardPhone = $companyStandardPhone;

        return $this;
    }

    public function getCompanyCountry()
    {
        return $this->companyCountry;
    }

    public function setCompanyCountry($companyCountry): self
    {
        $this->companyCountry = $companyCountry;

        return $this;
    }

    public function getCompanyPostalCode()
    {
        return $this->companyPostalCode;
    }

    public function setCompanyPostalCode($companyPostalCode): self
    {
        $this->companyPostalCode = $companyPostalCode;

        return $this;
    }

    public function getCompanyAddress()
    {
        return $this->companyAddress;
    }

    public function setCompanyAddress($companyAddress): self
    {
        $this->companyAddress = $companyAddress;

        return $this;
    }

    public function getCompanyTurnovers()
    {
        return $this->companyTurnovers;
    }

    public function setCompanyTurnovers($companyTurnovers): self
    {
        $this->companyTurnovers = $companyTurnovers;

        return $this;
    }

    public function getCompanyNbEmployees()
    {
        return $this->companyNbEmployees;
    }

    public function setCompanyNbEmployees($companyNbEmployees): self
    {
        $this->companyNbEmployees = $companyNbEmployees;

        return $this;
    }

    public function getCompanySiret()
    {
        return $this->companySiret;
    }

    public function setCompanySiret($companySiret): self
    {
        $this->companySiret = $companySiret;

        return $this;
    }

    public function getCompanyLegalStatus()
    {
        return $this->companyLegalStatus;
    }

    public function setCompanyLegalStatus($companyLegalStatus): self
    {
        $this->companyLegalStatus = $companyLegalStatus;

        return $this;
    }

    public function getCompanyNaf()
    {
        return $this->companyNaf;
    }

    public function setCompanyNaf($companyNaf): self
    {
        $this->companyNaf = $companyNaf;

        return $this;
    }

    public function getCompanyName()
    {
        return $this->companyName;
    }

    public function setCompanyName($companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getContactsPoste()
    {
        return $this->contactsPoste;
    }

    public function setContactsPoste($contactsPoste): self
    {
        $this->contactsPoste = $contactsPoste;

        return $this;
    }

    public function getContactsJob()
    {
        return $this->contactsJob;
    }

    public function setContactsJob($contactsJob): self
    {
        $this->contactsJob = $contactsJob;

        return $this;
    }

    public function getContactsFacebookAddress()
    {
        return $this->contactsFacebookAddress;
    }

    public function setContactsFacebookAddress($contactsFacebookAddress): self
    {
        $this->contactsFacebookAddress = $contactsFacebookAddress;

        return $this;
    }

    public function getContactsTwitterAddress()
    {
        return $this->contactsTwitterAddress;
    }

    public function setContactsTwitterAddress($contactsTwitterAddress): self
    {
        $this->contactsTwitterAddress = $contactsTwitterAddress;

        return $this;
    }

    public function getContactsLinkedinAddress()
    {
        return $this->contactsLinkedinAddress;
    }

    public function setContactsLinkedinAddress($contactsLinkedinAddress): self
    {
        $this->contactsLinkedinAddress = $contactsLinkedinAddress;

        return $this;
    }

    public function getContactsMobilePhone()
    {
        return $this->contactsMobilePhone;
    }

    public function setContactsMobilePhone($contactsMobilePhone): self
    {
        $this->contactsMobilePhone = $contactsMobilePhone;

        return $this;
    }

    public function getContactsPhone()
    {
        return $this->contactsPhone;
    }

    public function setContactsPhone($contactsPhone): self
    {
        $this->contactsPhone = $contactsPhone;

        return $this;
    }

    public function getContactsMailPro()
    {
        return $this->contactsMailPro;
    }

    public function setContactsMailPro($contactsMailPro): self
    {
        $this->contactsMailPro = $contactsMailPro;

        return $this;
    }

    public function getContactsBirthday()
    {
        return $this->contactsBirthday;
    }

    public function setContactsBirthday($contactsBirthday): self
    {
        $this->contactsBirthday = $contactsBirthday;

        return $this;
    }

    public function getContactsName()
    {
        return $this->contactsName;
    }

    public function setContactsName($contactsName): self
    {
        $this->contactsName = $contactsName;

        return $this;
    }

    public function getContactsFirstname()
    {
        return $this->contactsFirstname;
    }

    public function setContactsFirstname($contactsFirstname): self
    {
        $this->contactsFirstname = $contactsFirstname;

        return $this;
    }

    public function getContactsSexe()
    {
        return $this->contactsSexe;
    }

    /*// Génération d'une classe Proxy, identitque à celle ci, dont cette métohde est requise
    public function getcontacts_sexe()
    {
        return $this->contactsSexe;
    }*/


    public function setContactsSexe($contactsSexe): self
    {
        $this->contactsSexe = $contactsSexe;

        return $this;
    }

    public function getOperations(): ?Operations
    {
        return $this->operations;
    }

    public function setOperations(?Operations $operations): self
    {
        $this->operations = $operations;

        return $this;
    }
}
