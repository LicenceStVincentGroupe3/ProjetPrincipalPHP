<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParameterRepository")
 */
class Parameter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $parameterAppliName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $parameterCustomerLogo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $parameterAddress;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $parameterComplement;

    /**
     * @ORM\Column(type="string", length=14, nullable=true)
     */
    private $parameterPhone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $parameterFax;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $parameterEmail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $parameterEmailAdminAlert;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $parameterEmailContactForm;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commercial", inversedBy="idParameter")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCommercial;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ContactJob", inversedBy="idParameter")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idContactJob;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CompanyActivitySector", inversedBy="idParameter")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCompanyActivitySector;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CompanyBusinessCategory", inversedBy="idParameter")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCompanyBusinessCategory;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CompanyNbEmployee", inversedBy="idParameter")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCompanyNbEmployee;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CompanyTurnover", inversedBy="idParameter")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCompanyTurnover;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CompanyLastTurnover", inversedBy="idParameter")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCompanyLastTurnover;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ParameterTypeSite", inversedBy="idParameter")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idParameterTypeSite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ParameterObject", inversedBy="idParameter")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idParameterObject;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ParameterTarget", inversedBy="idParameter")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idParameterTarget;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ParameterBehavior", inversedBy="idParameter")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idParameterBehavior;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParameterAppliName(): ?string
    {
        return $this->parameterAppliName;
    }

    public function setParameterAppliName(string $parameterAppliName): self
    {
        $this->parameterAppliName = $parameterAppliName;

        return $this;
    }

    public function getParameterCustomerLogo(): ?string
    {
        return $this->parameterCustomerLogo;
    }

    public function setParameterCustomerLogo(string $parameterCustomerLogo): self
    {
        $this->parameterCustomerLogo = $parameterCustomerLogo;

        return $this;
    }

    public function getParameterAddress(): ?string
    {
        return $this->parameterAddress;
    }

    public function setParameterAddress(string $parameterAddress): self
    {
        $this->parameterAddress = $parameterAddress;

        return $this;
    }

    public function getParameterComplement(): ?string
    {
        return $this->parameterComplement;
    }

    public function setParameterComplement(?string $parameterComplement): self
    {
        $this->parameterComplement = $parameterComplement;

        return $this;
    }

    public function getParameterPhone(): ?string
    {
        return $this->parameterPhone;
    }

    public function setParameterPhone(?string $parameterPhone): self
    {
        $this->parameterPhone = $parameterPhone;

        return $this;
    }

    public function getParameterFax(): ?string
    {
        return $this->parameterFax;
    }

    public function setParameterFax(?string $parameterFax): self
    {
        $this->parameterFax = $parameterFax;

        return $this;
    }

    public function getParameterEmail(): ?string
    {
        return $this->parameterEmail;
    }

    public function setParameterEmail(string $parameterEmail): self
    {
        $this->parameterEmail = $parameterEmail;

        return $this;
    }

    public function getParameterEmailAdminAlert(): ?string
    {
        return $this->parameterEmailAdminAlert;
    }

    public function setParameterEmailAdminAlert(?string $parameterEmailAdminAlert): self
    {
        $this->parameterEmailAdminAlert = $parameterEmailAdminAlert;

        return $this;
    }

    public function getParameterEmailContactForm(): ?string
    {
        return $this->parameterEmailContactForm;
    }

    public function setParameterEmailContactForm(?string $parameterEmailContactForm): self
    {
        $this->parameterEmailContactForm = $parameterEmailContactForm;

        return $this;
    }

    public function getIdCommercial(): ?Commercial
    {
        return $this->idCommercial;
    }

    public function setIdCommercial(?Commercial $idCommercial): self
    {
        $this->idCommercial = $idCommercial;

        return $this;
    }

    public function getIdContactJob(): ?ContactJob
    {
        return $this->idContactJob;
    }

    public function setIdContactJob(?ContactJob $idContactJob): self
    {
        $this->idContactJob = $idContactJob;

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

    public function getIdParameterBehavior(): ?ParameterBehavior
    {
        return $this->idParameterBehavior;
    }

    public function setIdParameterBehavior(?ParameterBehavior $idParameterBehavior): self
    {
        $this->idParameterBehavior = $idParameterBehavior;

        return $this;
    }
}
