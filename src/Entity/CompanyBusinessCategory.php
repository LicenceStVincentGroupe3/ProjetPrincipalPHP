<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompanyBusinessCategoryRepository")
 */
class CompanyBusinessCategory
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
    private $label;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Parameter", mappedBy="idCompanyBusinessCategory")
     */
    private $idParameter;

    public function __construct()
    {
        $this->idParameter = new ArrayCollection();
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
            $idParameter->setIdCompanyBusinessCategory($this);
        }

        return $this;
    }

    public function removeIdParameter(Parameter $idParameter): self
    {
        if ($this->idParameter->contains($idParameter)) {
            $this->idParameter->removeElement($idParameter);
            // set the owning side to null (unless already changed)
            if ($idParameter->getIdCompanyBusinessCategory() === $this) {
                $idParameter->setIdCompanyBusinessCategory(null);
            }
        }

        return $this;
    }
}
