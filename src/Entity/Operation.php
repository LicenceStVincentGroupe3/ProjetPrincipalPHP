<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OperationRepository")
 */
class Operation
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
    private $operationName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $operationUrlPage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $operationHeadBandVisual;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $operationLateralVisual;

    /**
     * @ORM\Column(type="boolean")
     */
    private $operationDisplayed;

    /**
     * @ORM\Column(type="boolean")
     */
    private $operationModified;

    /**
     * @ORM\Column(type="boolean")
     */
    private $operationBinding;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOperationName(): ?string
    {
        return $this->operationName;
    }

    public function setOperationName(string $operationName): self
    {
        $this->operationName = $operationName;

        return $this;
    }

    public function getOperationUrlPage(): ?string
    {
        return $this->operationUrlPage;
    }

    public function setOperationUrlPage(string $operationUrlPage): self
    {
        $this->operationUrlPage = $operationUrlPage;

        return $this;
    }

    public function getOperationHeadBandVisual(): ?string
    {
        return $this->operationHeadBandVisual;
    }

    public function setOperationHeadBandVisual(string $operationHeadBandVisual): self
    {
        $this->operationHeadBandVisual = $operationHeadBandVisual;

        return $this;
    }

    public function getOperationLateralVisual(): ?string
    {
        return $this->operationLateralVisual;
    }

    public function setOperationLateralVisual(string $operationLateralVisual): self
    {
        $this->operationLateralVisual = $operationLateralVisual;

        return $this;
    }

    public function getOperationDisplayed(): ?bool
    {
        return $this->operationDisplayed;
    }

    public function setOperationDisplayed(bool $operationDisplayed): self
    {
        $this->operationDisplayed = $operationDisplayed;

        return $this;
    }

    public function getOperationModified(): ?bool
    {
        return $this->operationModified;
    }

    public function setOperationModified(bool $operationModified): self
    {
        $this->operationModified = $operationModified;

        return $this;
    }

    public function getOperationBinding(): ?bool
    {
        return $this->operationBinding;
    }

    public function setOperationBinding(bool $operationBinding): self
    {
        $this->operationBinding = $operationBinding;

        return $this;
    }
}
