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
     * @ORM\OneToMany(targetEntity="App\Entity\Parameter", mappedBy="idParameterTypeSite")
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
            $idParameter->setIdParameterTypeSite($this);
        }

        return $this;
    }

    public function removeIdParameter(Parameter $idParameter): self
    {
        if ($this->idParameter->contains($idParameter)) {
            $this->idParameter->removeElement($idParameter);
            // set the owning side to null (unless already changed)
            if ($idParameter->getIdParameterTypeSite() === $this) {
                $idParameter->setIdParameterTypeSite(null);
            }
        }

        return $this;
    }
}
