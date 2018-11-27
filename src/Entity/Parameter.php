<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\ManyToMany(targetEntity="App\Entity\ContactJob", inversedBy="parameters")
     */
    private $idParameterContactJob;

    public function __construct()
    {
        $this->contactJobs = new ArrayCollection();
        $this->idParameterContactJob = new ArrayCollection();
    }

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

    /**
     * @return Collection|ContactJob[]
     */
    public function getContactJobs(): Collection
    {
        return $this->contactJobs;
    }

    public function addContactJob(ContactJob $contactJob): self
    {
        if (!$this->contactJobs->contains($contactJob)) {
            $this->contactJobs[] = $contactJob;
            $contactJob->setIdParameter($this);
        }

        return $this;
    }

    public function removeContactJob(ContactJob $contactJob): self
    {
        if ($this->contactJobs->contains($contactJob)) {
            $this->contactJobs->removeElement($contactJob);
            // set the owning side to null (unless already changed)
            if ($contactJob->getIdParameter() === $this) {
                $contactJob->setIdParameter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ContactJob[]
     */
    public function getIdParameterContactJob(): Collection
    {
        return $this->idParameterContactJob;
    }

    public function addIdParameterContactJob(ContactJob $idParameterContactJob): self
    {
        if (!$this->idParameterContactJob->contains($idParameterContactJob)) {
            $this->idParameterContactJob[] = $idParameterContactJob;
        }

        return $this;
    }

    public function removeIdParameterContactJob(ContactJob $idParameterContactJob): self
    {
        if ($this->idParameterContactJob->contains($idParameterContactJob)) {
            $this->idParameterContactJob->removeElement($idParameterContactJob);
        }

        return $this;
    }
}
