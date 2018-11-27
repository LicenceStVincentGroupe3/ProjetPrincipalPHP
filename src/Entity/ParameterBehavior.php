<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParameterBehaviorRepository")
 */
class ParameterBehavior
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
    private $parameterBehaviorBehavior;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Company", mappedBy="idParameterBehavior")
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

    public function getParameterBehaviorBehavior(): ?string
    {
        return $this->parameterBehaviorBehavior;
    }

    public function setParameterBehaviorBehavior(string $parameterBehaviorBehavior): self
    {
        $this->parameterBehaviorBehavior = $parameterBehaviorBehavior;

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
            $company->setIdParameterBehavior($this);
        }

        return $this;
    }

    public function removeCompany(Company $company): self
    {
        if ($this->companies->contains($company)) {
            $this->companies->removeElement($company);
            // set the owning side to null (unless already changed)
            if ($company->getIdParameterBehavior() === $this) {
                $company->setIdParameterBehavior(null);
            }
        }

        return $this;
    }
}
