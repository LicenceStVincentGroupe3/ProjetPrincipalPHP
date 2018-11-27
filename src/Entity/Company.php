<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompanyRepository")
 */
class Company
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $CompanyFax;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $CompanyWebSite;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $CompanyCreationDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $CompanySiret;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $CompanyCodeNAF;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $CompanySource;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CompanyCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CompanyLastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CompanyDateCreatedPlug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CompanyDateUpdate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CompanyCodeCommercial;

    /**
     * @ORM\Column(type="boolean")
     */
    private $CompanyStatus;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CompanyLogo;

    /**
     * @ORM\Column(type="text")
     */
    private $CompanyComments;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CompanyAddress;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CompanyAddressSupplement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CompanyStandardPhone;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CompanyCountry", inversedBy="companies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCompanyCountry;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CompanyLegalStatus", inversedBy="companies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCompanyLegalStatus;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commercial", inversedBy="companies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idUser;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CompanyActivitySector", inversedBy="companies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCompanyActivitySector;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ParameterBehavior", inversedBy="companies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idParameterBehavior;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CompanyBusinessCategory", inversedBy="companies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCompanyBusinessCategory;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CompanyNbEmployee", inversedBy="companies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCompanyNbEmployee;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CompanyTurnover", inversedBy="companies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCompanyTurnover;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CompanyLastTurnover", inversedBy="companies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCompanyLastTurnover;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ParameterTypeSite", inversedBy="companies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idParameterTypeSite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ParameterObject", inversedBy="companies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idParameterObject;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ParameterTarget", inversedBy="companies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idParameterTarget;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getDateCreatedPlug(): ?\DateTimeInterface
    {
        return $this->dateCreatedPlug;
    }

    public function setDateCreatedPlug(\DateTimeInterface $dateCreatedPlug): self
    {
        $this->dateCreatedPlug = $dateCreatedPlug;

        return $this;
    }

    public function getDateUpdate(): ?\DateTimeInterface
    {
        return $this->dateUpdate;
    }

    public function setDateUpdate(\DateTimeInterface $dateUpdate): self
    {
        $this->dateUpdate = $dateUpdate;

        return $this;
    }

    public function getCommercialCode(): ?string
    {
        return $this->commercialCode;
    }

    public function setCommercialCode(?string $commercialCode): self
    {
        $this->commercialCode = $commercialCode;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(?string $comments): self
    {
        $this->comments = $comments;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getAddressSupplement(): ?string
    {
        return $this->addressSupplement;
    }

    public function setAddressSupplement(?string $addressSupplement): self
    {
        $this->addressSupplement = $addressSupplement;

        return $this;
    }

    public function getStandardPhone(): ?string
    {
        return $this->standardPhone;
    }

    public function setStandardPhone(?string $standardPhone): self
    {
        $this->standardPhone = $standardPhone;

        return $this;
    }

    public function getCompanyFax(): ?string
    {
        return $this->CompanyFax;
    }

    public function setCompanyFax(?string $CompanyFax): self
    {
        $this->CompanyFax = $CompanyFax;

        return $this;
    }

    public function getCompanyWebSite(): ?string
    {
        return $this->CompanyWebSite;
    }

    public function setCompanyWebSite(?string $CompanyWebSite): self
    {
        $this->CompanyWebSite = $CompanyWebSite;

        return $this;
    }

    public function getCompanyCreationDate(): ?\DateTimeInterface
    {
        return $this->CompanyCreationDate;
    }

    public function setCompanyCreationDate(?\DateTimeInterface $CompanyCreationDate): self
    {
        $this->CompanyCreationDate = $CompanyCreationDate;

        return $this;
    }

    public function getCompanySiret(): ?string
    {
        return $this->CompanySiret;
    }

    public function setCompanySiret(?string $CompanySiret): self
    {
        $this->CompanySiret = $CompanySiret;

        return $this;
    }

    public function getCompanyCodeNAF(): ?string
    {
        return $this->CompanyCodeNAF;
    }

    public function setCompanyCodeNAF(?string $CompanyCodeNAF): self
    {
        $this->CompanyCodeNAF = $CompanyCodeNAF;

        return $this;
    }

    public function getCompanySource(): ?string
    {
        return $this->CompanySource;
    }

    public function setCompanySource(?string $CompanySource): self
    {
        $this->CompanySource = $CompanySource;

        return $this;
    }

    public function getCompanyCode(): ?string
    {
        return $this->CompanyCode;
    }

    public function setCompanyCode(string $CompanyCode): self
    {
        $this->CompanyCode = $CompanyCode;

        return $this;
    }

    public function getCompanyLastName(): ?string
    {
        return $this->CompanyLastName;
    }

    public function setCompanyLastName(string $CompanyLastName): self
    {
        $this->CompanyLastName = $CompanyLastName;

        return $this;
    }

    public function getCompanyDateCreatedPlug(): ?string
    {
        return $this->CompanyDateCreatedPlug;
    }

    public function setCompanyDateCreatedPlug(string $CompanyDateCreatedPlug): self
    {
        $this->CompanyDateCreatedPlug = $CompanyDateCreatedPlug;

        return $this;
    }

    public function getCompanyDateUpdate(): ?string
    {
        return $this->CompanyDateUpdate;
    }

    public function setCompanyDateUpdate(string $CompanyDateUpdate): self
    {
        $this->CompanyDateUpdate = $CompanyDateUpdate;

        return $this;
    }

    public function getCompanyCodeCommercial(): ?string
    {
        return $this->CompanyCodeCommercial;
    }

    public function setCompanyCodeCommercial(string $CompanyCodeCommercial): self
    {
        $this->CompanyCodeCommercial = $CompanyCodeCommercial;

        return $this;
    }

    public function getCompanyStatus(): ?bool
    {
        return $this->CompanyStatus;
    }

    public function setCompanyStatus(bool $CompanyStatus): self
    {
        $this->CompanyStatus = $CompanyStatus;

        return $this;
    }

    public function getCompanyLogo(): ?string
    {
        return $this->CompanyLogo;
    }

    public function setCompanyLogo(string $CompanyLogo): self
    {
        $this->CompanyLogo = $CompanyLogo;

        return $this;
    }

    public function getCompanyComments(): ?string
    {
        return $this->CompanyComments;
    }

    public function setCompanyComments(string $CompanyComments): self
    {
        $this->CompanyComments = $CompanyComments;

        return $this;
    }

    public function getCompanyAddress(): ?string
    {
        return $this->CompanyAddress;
    }

    public function setCompanyAddress(string $CompanyAddress): self
    {
        $this->CompanyAddress = $CompanyAddress;

        return $this;
    }

    public function getCompanyAddressSupplement(): ?string
    {
        return $this->CompanyAddressSupplement;
    }

    public function setCompanyAddressSupplement(string $CompanyAddressSupplement): self
    {
        $this->CompanyAddressSupplement = $CompanyAddressSupplement;

        return $this;
    }

    public function getCompanyStandardPhone(): ?string
    {
        return $this->CompanyStandardPhone;
    }

    public function setCompanyStandardPhone(string $CompanyStandardPhone): self
    {
        $this->CompanyStandardPhone = $CompanyStandardPhone;

        return $this;
    }

    public function getIdCompanyCountry(): ?CompanyCountry
    {
        return $this->idCompanyCountry;
    }

    public function setIdCompanyCountry(?CompanyCountry $idCompanyCountry): self
    {
        $this->idCompanyCountry = $idCompanyCountry;

        return $this;
    }

    public function getIdCompanyLegalStatus(): ?CompanyLegalStatus
    {
        return $this->idCompanyLegalStatus;
    }

    public function setIdCompanyLegalStatus(?CompanyLegalStatus $idCompanyLegalStatus): self
    {
        $this->idCompanyLegalStatus = $idCompanyLegalStatus;

        return $this;
    }

    public function getIdUser(): ?Commercial
    {
        return $this->idUser;
    }

    public function setIdUser(?Commercial $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdCompanyActivitySector(): ?CompanyActivitySector
    {
        return $this->idCompanyActivitySector;
    }

    public function setIdCompanyActivitySector(?CompanyActivitySector $idCompanyActivitySector): self
    {
        $this->idCompanyActivitySector = $idCompanyActivitySector;

        return $this;
    }

    public function getIdParameterBehavior(): ?ParameterBehavior
    {
        return $this->idParameterBehavior;
    }

    public function setIdParameterBehavior(?ParameterBehavior $idParameterBehavior): self
    {
        $this->idParameterBehavior = $idParameterBehavior;

        return $this;
    }

    public function getIdCompanyBusinessCategory(): ?CompanyBusinessCategory
    {
        return $this->idCompanyBusinessCategory;
    }

    public function setIdCompanyBusinessCategory(?CompanyBusinessCategory $idCompanyBusinessCategory): self
    {
        $this->idCompanyBusinessCategory = $idCompanyBusinessCategory;

        return $this;
    }

    public function getIdCompanyNbEmployee(): ?CompanyNbEmployee
    {
        return $this->idCompanyNbEmployee;
    }

    public function setIdCompanyNbEmployee(?CompanyNbEmployee $idCompanyNbEmployee): self
    {
        $this->idCompanyNbEmployee = $idCompanyNbEmployee;

        return $this;
    }

    public function getIdCompanyTurnover(): ?CompanyTurnover
    {
        return $this->idCompanyTurnover;
    }

    public function setIdCompanyTurnover(?CompanyTurnover $idCompanyTurnover): self
    {
        $this->idCompanyTurnover = $idCompanyTurnover;

        return $this;
    }

    public function getIdCompanyLastTurnover(): ?CompanyLastTurnover
    {
        return $this->idCompanyLastTurnover;
    }

    public function setIdCompanyLastTurnover(?CompanyLastTurnover $idCompanyLastTurnover): self
    {
        $this->idCompanyLastTurnover = $idCompanyLastTurnover;

        return $this;
    }

    public function getIdParameterTypeSite(): ?ParameterTypeSite
    {
        return $this->idParameterTypeSite;
    }

    public function setIdParameterTypeSite(?ParameterTypeSite $idParameterTypeSite): self
    {
        $this->idParameterTypeSite = $idParameterTypeSite;

        return $this;
    }

    public function getIdParameterObject(): ?ParameterObject
    {
        return $this->idParameterObject;
    }

    public function setIdParameterObject(?ParameterObject $idParameterObject): self
    {
        $this->idParameterObject = $idParameterObject;

        return $this;
    }

    public function getIdParameterTarget(): ?ParameterTarget
    {
        return $this->idParameterTarget;
    }

    public function setIdParameterTarget(?ParameterTarget $idParameterTarget): self
    {
        $this->idParameterTarget = $idParameterTarget;

        return $this;
    }
}
