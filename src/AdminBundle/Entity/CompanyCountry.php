<?php

namespace App\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\CompanyCountryRepository")
 */
class CompanyCountry
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
    private $label;

    /**
     * @ORM\OneToMany(targetEntity="App\AdminBundle\Entity\Company", mappedBy="idCompanyCountry")
     */
    private $companies;

    /**
     * @ORM\OneToMany(targetEntity="App\AdminBundle\Entity\Commercial", mappedBy="idCompanyCountry")
     */
    private $commercials;

    public function __construct()
    {
        $this->companies = new ArrayCollection();
        $this->commercials = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

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
            $company->setIdCompanyCountry($this);
        }

        return $this;
    }

    /**
     * @return Collection|Commercial[]
     */
    public function getCommercials(): Collection
    {
        return $this->commercials;
    }

    public function addCommercial(Commercial $commercial): self
    {
        if (!$this->commercials->contains($commercial)) {
            $this->commercials[] = $commercial;
            $commercial->setIdCompanyCountry($this);
        }

        return $this;
    }

    public function removeCompany(Company $company): self
    {
        if ($this->companies->contains($company)) {
            $this->companies->removeElement($company);
            // set the owning side to null (unless already changed)
            if ($company->getIdCompanyCountry() === $this) {
                $company->setIdCompanyCountry(null);
            }
        }

        return $this;
    }

    public function removeCommercial(Commercial $commercial): self
    {
        if ($this->contacts->contains($commercial)) {
            $this->contacts->removeElement($commercial);
            // set the owning side to null (unless already changed)
            if ($commercial->getIdCompanyCountry() === $this) {
                $commercial->setIdCompanyCountry(null);
            }
        }
        
        return $this;
    }
}
