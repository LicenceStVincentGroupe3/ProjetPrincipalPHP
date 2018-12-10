<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommercialRepository")
 */
class Commercial
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
    private $commercialCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $commercialName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $commercialFirstname;

    /**
     * @ORM\Column(type="boolean")
     */
    private $commercialSexe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $commercialProfil;

    /**
     * @ORM\Column(type="datetime")
     */
    private $commercialPlugCreation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $commercialLastUpdate;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $commercialStatus;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $commercialBirthday;

    /**
     * @ORM\Column(type="string", length=14, nullable=true)
     */
    private $commercialPhone;

    /**
     * @ORM\Column(type="string", length=14, nullable=true)
     */
    private $commercialMobilePhone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commercialEmail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commercialLinkedinAddress;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commercialPhoto;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contact", mappedBy="idUser")
     */
    private $contacts;

    public function __construct()
    {
        $this->contacts = new ArrayCollection();
        $this->companies = new ArrayCollection();
    }
  
    /** 
     * @ORM\OneToMany(targetEntity="App\Entity\Company", mappedBy="idUser")
     */
    private $companies;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommercialCode(): ?string
    {
        return $this->commercialCode;
    }

    public function setCommercialCode(string $commercialCode): self
    {
        $this->commercialCode = $commercialCode;

        return $this;
    }

    public function getCommercialName(): ?string
    {
        return $this->commercialName;
    }

    public function setCommercialName(string $commercialName): self
    {
        $this->commercialName = $commercialName;

        return $this;
    }

    public function getCommercialFirstname(): ?string
    {
        return $this->commercialFirstname;
    }

    public function setCommercialFirstname(string $commercialFirstname): self
    {
        $this->commercialFirstname = $commercialFirstname;

        return $this;
    }

    public function getCommercialSexe(): ?bool
    {
        return $this->commercialSexe;
    }

    public function setCommercialSexe(bool $commercialSexe): self
    {
        $this->commercialSexe = $commercialSexe;

        return $this;
    }

    public function getCommercialProfil(): ?string
    {
        return $this->commercialProfil;
    }

    public function setCommercialProfil(string $commercialProfil): self
    {
        $this->commercialProfil = $commercialProfil;

        return $this;
    }

    public function getCommercialPlugCreation(): ?\DateTimeInterface
    {
        return $this->commercialPlugCreation;
    }

    public function setCommercialPlugCreation(\DateTimeInterface $commercialPlugCreation): self
    {
        $this->commercialPlugCreation = $commercialPlugCreation;

        return $this;
    }

    public function getCommercialLastUpdate(): ?\DateTimeInterface
    {
        return $this->commercialLastUpdate;
    }

    public function setCommercialLastUpdate(\DateTimeInterface $commercialLastUpdate): self
    {
        $this->commercialLastUpdate = $commercialLastUpdate;

        return $this;
    }

    public function getCommercialStatus(): ?bool
    {
        return $this->commercialStatus;
    }

    public function setCommercialStatus(?bool $commercialStatus): self
    {
        $this->commercialStatus = $commercialStatus;

        return $this;
    }

    public function getCommercialBirthday(): ?\DateTimeInterface
    {
        return $this->commercialBirthday;
    }

    public function setCommercialBirthday(?\DateTimeInterface $commercialBirthday): self
    {
        $this->commercialBirthday = $commercialBirthday;

        return $this;
    }

    public function getCommercialPhone(): ?string
    {
        return $this->commercialPhone;
    }

    public function setCommercialPhone(?string $commercialPhone): self
    {
        $this->commercialPhone = $commercialPhone;

        return $this;
    }

    public function getCommercialMobilePhone(): ?string
    {
        return $this->commercialMobilePhone;
    }

    public function setCommercialMobilePhone(?string $commercialMobilePhone): self
    {
        $this->commercialMobilePhone = $commercialMobilePhone;

        return $this;
    }

    public function getCommercialEmail(): ?string
    {
        return $this->commercialEmail;
    }

    public function setCommercialEmail(?string $commercialEmail): self
    {
        $this->commercialEmail = $commercialEmail;

        return $this;
    }

    public function getCommercialLinkedinAddress(): ?string
    {
        return $this->commercialLinkedinAddress;
    }

    public function setCommercialLinkedinAddress(?string $commercialLinkedinAddress): self
    {
        $this->commercialLinkedinAddress = $commercialLinkedinAddress;

        return $this;
    }

    public function getCommercialPhoto(): ?string
    {
        return $this->commercialPhoto;
    }

    public function setCommercialPhoto(?string $commercialPhoto): self
    {
        $this->commercialPhoto = $commercialPhoto;

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
            $contact->setIdUser($this);
        }
    }
  
    /**
     * @return Collection|Company[]
     */
    public function getCompanies(): Collection
    {
        return $this->companies;
    }

    public function addCompany(Company $company): self
    {
        if (!$this->companies->contains($company)) {
            $this->companies[] = $company;
            $company->setIdUser($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->contains($contact)) {
            $this->contacts->removeElement($contact);
            // set the owning side to null (unless already changed)
            if ($contact->getIdUser() === $this) {
                $contact->setIdUser(null);
            }
        }
    }
  
    public function removeCompany(Company $company): self
    {
        if ($this->companies->contains($company)) {
            $this->companies->removeElement($company);
            // set the owning side to null (unless already changed)
            if ($company->getIdUser() === $this) {
                $company->setIdUser(null);
            }
        }

        return $this;
    }
}
