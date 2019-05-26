<?php

namespace App\AdminBundle\Entity;

use App\AdminBundle\Entity\CompanyCountry;
use App\AdminBundle\Entity\CompanyTurnover;
use App\AdminBundle\Entity\ContactJob;
use App\AdminBundle\Entity\CompanyActivitySector;
use App\AdminBundle\Entity\CompanyNbEmployee;

use Symfony\Component\Validator\Constraints as Assert;

class ContactOperation
{
    /**
     * @var string
     * @Assert\NotBlank(message = "Ce champ ne peut être vide.")
     */
    private $contactOperationName;

    /**
     * @var string|null
     * @Assert\Length(max = 255)
     */
    private $contactOperationAddress;

    /**
     * @var string|null
     * @Assert\Length(max = 255)
     */
    private $contactOperationCity;

    /**
     * @var string|null
     */
    private $contactOperationPostalCode;

    /**
     * @var string|null
     * @Assert\Length(min = 10, minMessage = "Tel. 10 caractères minimun !")
     * @Assert\Length(max = 10, maxMessage = "Tel. 10 caractères maxnimun !")
     * @Assert\Regex(pattern="/^(\(0\))?[0-9]+$/", message="Format : 0301010101")
     */
    private $contactOperationCompanyPhone;

    /**
     * @var string|null
     * @Assert\Length(min = 10, minMessage = "Tel. 10 caractères minimun !")
     * @Assert\Length(max = 10, maxMessage = "Tel. 10 caractères maxnimun !")
     * @Assert\Regex(pattern="/^(\(0\))?[0-9]+$/", message="Format : 0301010101")
     */
    private $contactOperationFax;

    /**
     * @var string|null
     * @Assert\Url(message = "Veuillez insérer une URL valide")
     */
    private $contactOperationWebSite;

    /**
     * @var string|null
     * @Assert\Url(message = "Veuillez insérer une URL valide")
     */
    private $contactOperationCompanyEmail;

    /**
     * @var string|null
     * @Assert\Url(message = "Veuillez insérer une URL valide")
     */
    private $contactOperationContactLinkedinAddress;

    /**
     * @var string|null
     * @Assert\Url(message = "Veuillez insérer une URL valide")
     */
    private $contactOperationContactFacebookAddress;


    /**
     * @var string|null
     * @Assert\Url(message = "Veuillez insérer une URL valide")
     */
    private $contactOperationContactTwitterAddress;

    /**
     * @var string|null
     * @Assert\Length(min = 14, max = 14, exactMessage = "Le numéro de SIRET doit contenir 14 caractères.")
     */
    private $contactOperationSiret;

    /**
     * @var CompanyCountry
     */
    private $country;

    /**
     * @var CompanyActivitySector
     */
    private $companyActivitySector;

    /**
     * @var CompanyNbEmployee
     */
    private $companyNbEmployees;

    /**
     * @var CompanyTurnover
     */
    private $companyTurnovers;

    /**
     * @var string
     */
    private $contactOperationContactSexe;

    /**
     * @var string
     */
    private $contactOperationContactName;

    /**
     * @var string
     */
    private $contactOperationContactFirstName;

    /**
     * @var \DateTime|null
     */
    private $contactOperationContactBirthday;

    /**
     * @var string|null
     * @Assert\Length(min = 10, minMessage = "Tel. 10 caractères minimun !")
     * @Assert\Length(max = 10, maxMessage = "Tel. 10 caractères maxnimun !")
     * @Assert\Regex(pattern="/^(\(0\))?[0-9]+$/", message="Format : 0601010101")
     */
    private $contactOperationContactMobilePhone;

    /**
     * @var string|null
     * @Assert\Length(min = 10, minMessage = "Tel. 10 caractères minimun !")
     * @Assert\Length(max = 10, maxMessage = "Tel. 10 caractères maxnimun !")
     * @Assert\Regex(pattern="/^(\(0\))?[0-9]+$/", message="Format : 0301010101")
     */
    private $contactOperationContactPhone;

    /**
     * @var string|null
     * @Assert\Length(min = 10, minMessage = "Tel. 10 caractères minimun !")
     * @Assert\Length(max = 10, maxMessage = "Tel. 10 caractères maxnimun !")
     * @Assert\Regex(pattern="/^(\(0\))?[0-9]+$/", message="Format : 0301010101")
     */
    private $contactOperationContactStandardPhone;

    /**
     * @var string|null
     * @Assert\Length(max = 255)
     */
    private $contactOperationContactworkName;

    /**
     * @var string|null
     * @Assert\Email(message = "Veuillez insérer un email valide")
     */
    private $contactOperationContactEmail;


    /**
     * @var ContactJob|null
     */
    private $contactJob;

    public function getContactJob(): ?ContactJob
    {
        return $this->contactJob;
    }

    public function setContactJob(?ContactJob $contactJob): self
    {
        $this->contactJob = $contactJob;

        return $this;
    }

    public function getContactOperationContactTwitterAddress(): ?string
    {
        return $this->contactOperationContactTwitterAddress;
    }

    public function setContactOperationContactTwitterAddress(?string $contactOperationContactTwitterAddress): self
    {
        $this->contactOperationContactTwitterAddress = $contactOperationContactTwitterAddress;

        return $this;
    }

    public function getContactOperationContactFacebookAddress(): ?string
    {
        return $this->contactOperationContactFacebookAddress;
    }

    public function setContactOperationContactFacebookAddress(?string $contactOperationContactFacebookAddress): self
    {
        $this->contactOperationContactFacebookAddress = $contactOperationContactFacebookAddress;

        return $this;
    } 

    public function getContactOperationContactLinkedinAddress(): ?string
    {
        return $this->contactOperationContactLinkedinAddress;
    }

    public function setContactOperationContactLinkedinAddress(?string $contactOperationContactLinkedinAddress): self
    {
        $this->contactOperationContactLinkedinAddress = $contactOperationContactLinkedinAddress;

        return $this;
    }

    public function getContactOperationContactworkName(): ?string
    {
        return $this->contactOperationContactworkName;
    }

    public function setContactOperationContactworkName(?string $contactOperationContactworkName): self
    {
        $this->contactOperationContactworkName = $contactOperationContactworkName;

        return $this;
    }

    public function getContactOperationContactEmail(): ?string
    {
        return $this->contactOperationContactEmail;
    }

    public function setContactOperationContactEmail(?string $contactOperationContactEmail): self
    {
        $this->contactOperationContactEmail = $contactOperationContactEmail;

        return $this;
    }

    public function getContactOperationContactStandardPhone(): ?string
    {
        return $this->contactOperationContactStandardPhone;
    }

    public function setContactOperationContactStandardPhone(?string $contactOperationContactStandardPhone): self
    {
        $this->contactOperationContactStandardPhone = $contactOperationContactStandardPhone;

        return $this;
    }

    public function getContactOperationContactPhone(): ?string
    {
        return $this->contactOperationContactPhone;
    }

    public function setContactOperationContactPhone(?string $contactOperationContactPhone): self
    {
        $this->contactOperationContactPhone = $contactOperationContactPhone;

        return $this;
    }

    public function getContactOperationContactMobilePhone(): ?string
    {
        return $this->contactOperationContactMobilePhone;
    }

    public function setContactOperationContactMobilePhone(?string $contactOperationContactMobilePhone): self
    {
        $this->contactOperationContactMobilePhone = $contactOperationContactMobilePhone;

        return $this;
    }

    /**
     * @return  \DateTime|null
     */
    public function getContactOperationContactBirthday()
    {
        return $this->contactOperationContactBirthday;
    }

    /**
     * @param  \DateTime|null  $contactOperationContactBirthday
     *
     * @return  self
     */
    public function setContactOperationContactBirthday($contactOperationContactBirthday)
    {
        $this->contactOperationContactBirthday = $contactOperationContactBirthday;

        return $this;
    }

    public function getContactOperationContactFirstName(): ?string
    {
        return $this->contactOperationContactFirstName;
    }

    public function setContactOperationContactFirstName(?string $contactOperationContactFirstName): self
    {
        $this->contactOperationContactFirstName = $contactOperationContactFirstName;

        return $this;
    }

    public function getContactOperationContactName(): ?string
    {
        return $this->contactOperationContactName;
    }

    public function setContactOperationContactName(?string $contactOperationContactName): self
    {
        $this->contactOperationContactName = $contactOperationContactName;

        return $this;
    }

    public function getContactOperationContactSexe(): ?string
    {
        return $this->contactOperationContactSexe;
    }

    public function setContactOperationContactSexe(?string $contactOperationContactSexe): self
    {
        $this->contactOperationContactSexe = $contactOperationContactSexe;

        return $this;
    }

    public function getCompanyTurnovers(): ?CompanyTurnover
    {
        return $this->companyTurnovers;
    }

    public function setCompanyTurnovers(?CompanyTurnover $companyTurnovers): self
    {
        $this->companyTurnovers = $companyTurnovers;

        return $this;
    }

    public function getCompanyNbEmployees(): ?CompanyNbEmployee
    {
        return $this->companyNbEmployees;
    }

    public function setCompanyNbEmployees(?CompanyNbEmployee $companyNbEmployees): self
    {
        $this->companyNbEmployees = $companyNbEmployees;

        return $this;
    }

    public function getCompanyActivitySector(): ?CompanyActivitySector
    {
        return $this->companyActivitySector;
    }

    public function setCompanyActivitySector(?CompanyActivitySector $companyActivitySector): self
    {
        $this->companyActivitySector = $companyActivitySector;

        return $this;
    }

    public function getContactOperationCompanyEmail(): ?string
    {
        return $this->contactOperationCompanyEmail;
    }

    public function setContactOperationCompanyEmail(?string $contactOperationCompanyEmail): self
    {
        $this->contactOperationCompanyEmail = $contactOperationCompanyEmail;

        return $this;
    }

    public function getContactOperationSiret(): ?string
    {
        return $this->contactOperationSiret;
    }

    public function setContactOperationSiret(?string $contactOperationSiret): self
    {
        $this->contactOperationSiret = $contactOperationSiret;

        return $this;
    }

    public function getContactOperationWebSite(): ?string
    {
        return $this->contactOperationWebSite;
    }

    public function setContactOperationWebSite(?string $contactOperationWebSite): self
    {
        $this->contactOperationWebSite = $contactOperationWebSite;

        return $this;
    }

    public function getContactOperationFax(): ?string
    {
        return $this->contactOperationFax;
    }

    public function setContactOperationFax(?string $contactOperationFax): self
    {
        $this->contactOperationFax = $contactOperationFax;

        return $this;
    }

    public function getContactOperationCompanyPhone(): ?string
    {
        return $this->contactOperationCompanyPhone;
    }

    public function setContactOperationCompanyPhone(?string $contactOperationCompanyPhone): self
    {
        $this->contactOperationCompanyPhone = $contactOperationCompanyPhone;

        return $this;
    }

    public function getContactOperationCity(): ?string
    {
        return $this->contactOperationCity;
    }

    public function setContactOperationCity(?string $contactOperationCity): self
    {
        $this->contactOperationCity = $contactOperationCity;

        return $this;
    }

    public function getContactOperationPostalCode(): ?string
    {
        return $this->contactOperationPostalCode;
    }

    public function setContactOperationPostalCode(?string $contactOperationPostalCode): self
    {
        $this->contactOperationPostalCode = $contactOperationPostalCode;

        return $this;
    }

    public function getContactOperationAddress(): ?string
    {
        return $this->contactOperationAddress;
    }

    public function setContactOperationAddress(?string $contactOperationAddress): self
    {
        $this->contactOperationAddress = $contactOperationAddress;

        return $this;
    }

    public function getCountry(): ?CompanyCountry
    {
        return $this->country;
    }

    public function setCountry(?CompanyCountry $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getNameCompany(): ?string
    {
        return $this->contactOperationName;
    }

    public function setNameCompany(?string $contactOperationName): self
    {
        $this->contactOperationName = $contactOperationName;

        return $this;
    }
}
