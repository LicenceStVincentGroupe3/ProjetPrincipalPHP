<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OperationTypeOperationRepository")
 */
class OperationTypeOperation
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
    private $operationTypeOperationHtmlTemplateName;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Operation", mappedBy="idOperationTypeOperation")
     */
    private $idOperation;

    public function __construct()
    {
        $this->idOperation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOperationTypeOperationHtmlTemplateName(): ?string
    {
        return $this->operationTypeOperationHtmlTemplateName;
    }

    public function setOperationTypeOperationHtmlTemplateName(string $operationTypeOperationHtmlTemplateName): self
    {
        $this->operationTypeOperationHtmlTemplateName = $operationTypeOperationHtmlTemplateName;

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
            $idOperation->setIdOperationTypeOperation($this);
        }

        return $this;
    }

    public function removeIdOperation(Operation $idOperation): self
    {
        if ($this->idOperation->contains($idOperation)) {
            $this->idOperation->removeElement($idOperation);
            // set the owning side to null (unless already changed)
            if ($idOperation->getIdOperationTypeOperation() === $this) {
                $idOperation->setIdOperationTypeOperation(null);
            }
        }

        return $this;
    }
}
