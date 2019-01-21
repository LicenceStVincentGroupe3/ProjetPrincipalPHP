<?php

namespace App\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParticipationRepository")
 */
class Participation
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
    private $codeParticipation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Operation", inversedBy="participations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idOperation;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ContactJob", inversedBy="participations")
     */
    private $idParticipationContact;

    public function __construct()
    {
        $this->idParticipationContact = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeParticipation(): ?string
    {
        return $this->codeParticipation;
    }

    public function setCodeParticipation(string $codeParticipation): self
    {
        $this->codeParticipation = $codeParticipation;

        return $this;
    }

    public function getIdOperation(): ?Operation
    {
        return $this->idOperation;
    }

    public function setIdOperation(?Operation $idOperation): self
    {
        $this->idOperation = $idOperation;

        return $this;
    }

    /**
     * @return Collection|ContactJob[]
     */
    public function getIdParticipationContact(): Collection
    {
        return $this->idParticipationContact;
    }

    public function addIdParticipationContact(ContactJob $idParticipationContact): self
    {
        if (!$this->idParticipationContact->contains($idParticipationContact)) {
            $this->idParticipationContact[] = $idParticipationContact;
        }

        return $this;
    }

    public function removeIdParticipationContact(ContactJob $idParticipationContact): self
    {
        if ($this->idParticipationContact->contains($idParticipationContact)) {
            $this->idParticipationContact->removeElement($idParticipationContact);
        }

        return $this;
    }
}
