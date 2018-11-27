<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParameterTypeSiteRepository")
 */
class ParameterTypeSite
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
    private $parameterTypeSiteLabel;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Company", mappedBy="idParameterTypeSite")
     */
    private $companies;

    public function __construct()
    {
        $this->companies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParameterTypeSiteLabel(): ?string
    {
        return $this->parameterTypeSiteLabel;
    }

    public function setParameterTypeSiteLabel(string $parameterTypeSiteLabel): self
    {
        $this->parameterTypeSiteLabel = $parameterTypeSiteLabel;

        return $this;
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
            $company->setIdParameterTypeSite($this);
        }

        return $this;
    }

    public function removeCompany(Company $company): self
    {
        if ($this->companies->contains($company)) {
            $this->companies->removeElement($company);
            // set the owning side to null (unless already changed)
            if ($company->getIdParameterTypeSite() === $this) {
                $company->setIdParameterTypeSite(null);
            }
        }

        return $this;
    }
}
