<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParameterObjectRepository")
 */
class ParameterObject
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
    private $parameterObjectObject;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Parameter", mappedBy="idParameterObject")
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

    public function getParameterObjectObject(): ?string
    {
        return $this->parameterObjectObject;
    }

    public function setParameterObjectObject(string $parameterObjectObject): self
    {
        $this->parameterObjectObject = $parameterObjectObject;

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
            $idParameter->setIdParameterObject($this);
        }

        return $this;
    }

    public function removeIdParameter(Parameter $idParameter): self
    {
        if ($this->idParameter->contains($idParameter)) {
            $this->idParameter->removeElement($idParameter);
            // set the owning side to null (unless already changed)
            if ($idParameter->getIdParameterObject() === $this) {
                $idParameter->setIdParameterObject(null);
            }
        }

        return $this;
    }
}
