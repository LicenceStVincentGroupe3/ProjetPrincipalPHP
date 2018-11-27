<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParameterTargetRepository")
 */
class ParameterTarget
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
    private $parameterTargetTarget;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Parameter", mappedBy="idParameterTarget")
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

    public function getParameterTargetTarget(): ?string
    {
        return $this->parameterTargetTarget;
    }

    public function setParameterTargetTarget(string $parameterTargetTarget): self
    {
        $this->parameterTargetTarget = $parameterTargetTarget;

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
            $idParameter->setIdParameterTarget($this);
        }

        return $this;
    }

    public function removeIdParameter(Parameter $idParameter): self
    {
        if ($this->idParameter->contains($idParameter)) {
            $this->idParameter->removeElement($idParameter);
            // set the owning side to null (unless already changed)
            if ($idParameter->getIdParameterTarget() === $this) {
                $idParameter->setIdParameterTarget(null);
            }
        }

        return $this;
    }
}
