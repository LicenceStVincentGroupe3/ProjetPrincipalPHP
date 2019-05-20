<?php

namespace App\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\OperationRepository")
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
     * @Assert\NotBlank
     */
    private $operationCode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $operationName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $emailSubject;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbAutoRelaunching;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime
     */
    private $sendingDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime
     */
    private $closingDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $infos;

    /**
     * @ORM\Column(type="boolean")
     */
    private $commercialOffer;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $remarks;

    /**
     * @ORM\ManyToOne(targetEntity="App\AdminBundle\Entity\Commercial", inversedBy="operations")
     * @ORM\JoinColumn(nullable=true)
     */
    private $idCommercial;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url
     */
    private $operationUrlPage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $operationHeadBandVisual;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $operationLateralVisual;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $operationDisplayed;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $operationModified;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $operationBinding;

    /**
     * @ORM\OneToMany(targetEntity="App\AdminBundle\Entity\Participation", mappedBy="idOperation")
     */
    private $participations;

    public function __construct()
    {
        $this->participations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOperationCode(): ?string
    {
        return $this->operationCode;
    }

    public function setOperationCode(string $operationCode): self
    {
        $this->operationCode = $operationCode;

        return $this;
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

    public function getEmailSubject(): ?string
    {
        return $this->emailSubject;
    }

    public function setEmailSubject(string $emailSubject): self
    {
        $this->emailSubject = $emailSubject;

        return $this;
    }

    public function getNbAutoRelaunching(): ?int
    {
        return $this->nbAutoRelaunching;
    }

    public function setNbAutoRelaunching(int $nbAutoRelaunching): self
    {
        $this->nbAutoRelaunching = $nbAutoRelaunching;

        return $this;
    }

    public function getSendingDate(): ?\DateTimeInterface
    {
        return $this->sendingDate;
    }

    public function setSendingDate(?\DateTimeInterface $sendingDate): self
    {
        $this->sendingDate = $sendingDate;

        return $this;
    }

    public function getClosingDate(): ?\DateTimeInterface
    {
        return $this->closingDate;
    }

    public function setClosingDate(?\DateTimeInterface $closingDate): self
    {
        $this->closingDate = $closingDate;

        return $this;
    }

    public function getInfos(): ?bool
    {
        return $this->infos;
    }

    public function setInfos(?bool $infos): self
    {
        $this->infos = $infos;

        return $this;
    }

    public function getCommercialOffer(): ?bool
    {
        return $this->commercialOffer;
    }

    public function setCommercialOffer(?bool $commercialOffer): self
    {
        $this->commercialOffer = $commercialOffer;

        return $this;
    }

    public function getRemarks(): ?string
    {
        return $this->remarks;
    }

    public function setRemarks(?string $remarks): self
    {
        $this->remarks = $remarks;

        return $this;
    }

    public function getIdCommercial(): ?Commercial
    {
        return $this->idCommercial;
    }

    public function setIdCommercial(?Commercial $idCommercial): self
    {
        $this->idCommercial = $idCommercial;

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

    /**
     * @return Collection|Participation[]
     */
    public function getParticipations(): Collection
    {
        return $this->participations;
    }

    public function addParticipation(Participation $participation): self
    {
        if (!$this->participations->contains($participation)) {
            $this->participations[] = $participation;
            $participation->setIdOperation($this);
        }

        return $this;
    }

    public function removeParticipation(Participation $participation): self
    {
        if ($this->participations->contains($participation)) {
            $this->participations->removeElement($participation);
            // set the owning side to null (unless already changed)
            if ($participation->getIdOperation() === $this) {
                $participation->setIdOperation(null);
            }
        }

        return $this;
    }
}
