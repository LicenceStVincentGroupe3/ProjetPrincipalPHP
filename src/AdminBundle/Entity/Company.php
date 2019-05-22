<?php

namespace App\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\CompanyRepository")
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
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $CompanyCode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $CompanyLastName;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $CompanyDateUpdate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $CompanyStatus;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\File(mimeTypes={ "image/jpeg", "image/png" })
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
     * @ORM\Column(type="string", length=10)
     */
    private $CompanyPostalCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CompanyCity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $CompanyFax;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url
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
     * @ORM\Column(type="string", length=255)
     */
    private $CompanyStandardPhone;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $CompanyEmail;

    /**
     * @ORM\Column(type="integer", length=11)
     */
    private $CompanyPotential;

    /**
     * @ORM\OneToMany(targetEntity="App\AdminBundle\Entity\Contact", mappedBy="idCompany")
     */
    private $contacts;

    public function __construct()
    {
        $this->contacts = new ArrayCollection();
    }
  
    /**
     * @ORM\ManyToOne(targetEntity="App\AdminBundle\Entity\CompanyCountry", inversedBy="companies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCompanyCountry;

    /**
     * @ORM\ManyToOne(targetEntity="App\AdminBundle\Entity\CompanyStatus", inversedBy="companies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCompanyStatus;

    /**
     * @ORM\ManyToOne(targetEntity="App\AdminBundle\Entity\Commercial", inversedBy="companies")
     * @ORM\JoinColumn(nullable=true)
     */
    private $idUser;

    /**
     * @ORM\ManyToOne(targetEntity="App\AdminBundle\Entity\CompanyLegalStatus", inversedBy="companies")
     * @ORM\JoinColumn(nullable=true)
     */
    private $idCompanyLegalStatus;

    /**
     * @ORM\ManyToOne(targetEntity="App\AdminBundle\Entity\CompanyActivitySector", inversedBy="companies")
     * @ORM\JoinColumn(nullable=true)
     */
    private $idCompanyActivitySector;

    /**
     * @ORM\ManyToOne(targetEntity="App\AdminBundle\Entity\CompanyNbEmployee", inversedBy="companies")
     * @ORM\JoinColumn(nullable=true)
     */
    private $idCompanyNbEmployee;

    /**
     * @ORM\ManyToOne(targetEntity="App\AdminBundle\Entity\CompanyTurnover", inversedBy="companies")
     * @ORM\JoinColumn(nullable=true)
     */
    private $idCompanyTurnover;

    /**
     * @ORM\ManyToOne(targetEntity="App\AdminBundle\Entity\CompanyCodeNAF", inversedBy="companies")
     * @ORM\JoinColumn(nullable=true)
     */
    private $idCompanyCodeNAF;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCompanyStatus(): ?bool
    {
        return $this->CompanyStatus;
    }

    public function setCompanyStatus(?bool $CompanyStatus): self
    {
        $this->CompanyStatus = $CompanyStatus;

        return $this;
    }

    public function getCompanyLogo(): ?string
    {
        return $this->CompanyLogo;
    }

    public function setCompanyLogo(?string $CompanyLogo): self
    {
        $this->CompanyLogo = $CompanyLogo;

        return $this;
    }

    public function getCompanyComments(): ?string
    {
        return $this->CompanyComments;
    }

    public function setCompanyComments(?string $CompanyComments): self
    {
        $this->CompanyComments = $CompanyComments;

        return $this;
    }

    public function getCompanyAddress(): ?string
    {
        return $this->CompanyAddress;
    }

    public function setCompanyAddress(?string $CompanyAddress): self
    {
        $this->CompanyAddress = $CompanyAddress;

        return $this;
    }

    public function getCompanyStandardPhone(): ?string
    {
        return $this->CompanyStandardPhone;
    }

    public function setCompanyStandardPhone(?string $CompanyStandardPhone): self
    {
        $this->CompanyStandardPhone = $CompanyStandardPhone;

        return $this;
    }

    public function getCompanyEmail(): ?int
    {
        return $this->CompanyEmail;
    }

    public function setCompanyEmail(?int $CompanyEmail): self
    {
        $this->CompanyEmail = $CompanyEmail;

        return $this;
    }

    public function getCompanyPotential(): ?int
    {
        return $this->CompanyPotential;
    }

    public function setCompanyPotential(?int $CompanyPotential): self
    {
        $this->CompanyPotential = $CompanyPotential;

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

    public function getCompanySiret(): ?string
    {
        return $this->CompanySiret;
    }

    public function setCompanySiret(?string $CompanySiret): self
    {
        $this->CompanySiret = $CompanySiret;

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

    /**
     * @return Collection|Contact[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->setIdCompany($this);
        }
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
  
    public function getIdUser(): ?Commercial
    {
        return $this->idUser;
    }

    public function setIdUser(?Commercial $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->contains($contact)) {
            $this->contacts->removeElement($contact);
            // set the owning side to null (unless already changed)
            if ($contact->getIdCompany() === $this) {
                $contact->setIdCompany(null);
            }
        }
    }

    public function getIdCompanyStatus(): ?CompanyStatus
    {
        return $this->idCompanyStatus;
    }

    public function setIdCompanyStatus(?CompanyStatus $idCompanyStatus): self
    {
        $this->idCompanyStatus = $idCompanyStatus;

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

    public function getIdCompanyCodeNAF(): ?CompanyCodeNAF
    {
        return $this->idCompanyCodeNAF;
    }

    public function setIdCompanyCodeNAF(?CompanyCodeNAF $idCompanyCodeNAF): self
    {
        $this->idCompanyCodeNAF = $idCompanyCodeNAF;

        return $this;
    }
  
    public function getCompanyCreationDate(): ?\DateTimeInterface
    {
        return $this->CompanyCreationDate;
    }

    public function setCompanyCreationDate(\DateTimeInterface $CompanyCreationDate): self
    {
        $this->CompanyCreationDate = $CompanyCreationDate;

        return $this;
    }

    public function getCompanyDateUpdate(): ?\DateTimeInterface
    {
        return $this->CompanyDateUpdate;
    }

    public function setCompanyDateUpdate(\DateTimeInterface $CompanyDateUpdate): self
    {
        $this->CompanyDateUpdate = $CompanyDateUpdate;

        return $this;
    }

    public function getCompanyPostalCode(): ?string
    {
        return $this->CompanyPostalCode;
    }

    public function setCompanyPostalCode(string $CompanyPostalCode): self
    {
        $this->CompanyPostalCode = $CompanyPostalCode;

        return $this;
    }

    public function getCompanyCity(): ?string
    {
        return $this->CompanyCity;
    }

    public function setCompanyCity(string $CompanyCity): self
    {
        $this->CompanyCity = $CompanyCity;

        return $this;
    }
}
