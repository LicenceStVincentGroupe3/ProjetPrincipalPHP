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
     * @ORM\OneToMany(targetEntity="App\Entity\Operation", mappedBy="idCommercial")
     */
    private $idOperation;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Commercial", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $commercialManager;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Commercial", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $commercialWorker;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Parameter", mappedBy="idCommercial")
     */
    private $idParameter;

    public function __construct()
    {
        $this->idOperation = new ArrayCollection();
        $this->idParameter = new ArrayCollection();
    }

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
     * @return Collection|Operation[]
     */
    public function getIdOperation(): Collection
    {
        return $this->idOperation;
    }

    public function addIdOperation(Operation $idOperation): self
    {
        if (!$this->idOperation->contains($idOperation)) {
            $this->idOperation[] = $idOperation;
            $idOperation->setIdCommercial($this);
        }

        return $this;
    }

    public function removeIdOperation(Operation $idOperation): self
    {
        if ($this->idOperation->contains($idOperation)) {
            $this->idOperation->removeElement($idOperation);
            // set the owning side to null (unless already changed)
            if ($idOperation->getIdCommercial() === $this) {
                $idOperation->setIdCommercial(null);
            }
        }

        return $this;
    }

    public function getCommercialManager(): ?self
    {
        return $this->commercialManager;
    }

    public function setCommercialManager(self $commercialManager): self
    {
        $this->commercialManager = $commercialManager;

        return $this;
    }

    public function getCommercialWorker(): ?self
    {
        return $this->commercialWorker;
    }

    public function setCommercialWorker(self $commercialWorker): self
    {
        $this->commercialWorker = $commercialWorker;

        return $this;
    }

    /**
     * @return Collection|Parameter[]
     */
    public function getIdParameter(): Collection
    {
        return $this->idParameter;
    }

    public function addIdParameter(Parameter $idParameter): self
    {
        if (!$this->idParameter->contains($idParameter)) {
            $this->idParameter[] = $idParameter;
            $idParameter->setIdCommercial($this);
        }

        return $this;
    }

    public function removeIdParameter(Parameter $idParameter): self
    {
        if ($this->idParameter->contains($idParameter)) {
            $this->idParameter->removeElement($idParameter);
            // set the owning side to null (unless already changed)
            if ($idParameter->getIdCommercial() === $this) {
                $idParameter->setIdCommercial(null);
            }
        }

        return $this;
    }
}
