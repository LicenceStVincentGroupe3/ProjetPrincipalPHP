<?php

namespace App\Entity;

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
}
