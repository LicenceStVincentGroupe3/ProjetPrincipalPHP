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
     * @ORM\OneToMany(targetEntity="App\Entity\Parameter", mappedBy="idParameterBehavior")
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
            $idParameter->setIdParameterBehavior($this);
        }

        return $this;
    }

    public function removeIdParameter(Parameter $idParameter): self
    {
        if ($this->idParameter->contains($idParameter)) {
            $this->idParameter->removeElement($idParameter);
            // set the owning side to null (unless already changed)
            if ($idParameter->getIdParameterBehavior() === $this) {
                $idParameter->setIdParameterBehavior(null);
            }
        }

        return $this;
    }
}
