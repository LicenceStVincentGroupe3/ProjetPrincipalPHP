<?php

namespace App\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\AffectedZoneRepository")
 */
class AffectedZone
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
    private $label;

    /**
     * @ORM\OneToMany(targetEntity="App\AdminBundle\Entity\Commercial", mappedBy="idAffectedZone")
     */
    private $commercials;

    public function __construct()
    {
        $this->commercials = new ArrayCollection();
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
     * @return Collection|Commercial[]
     */
    public function getCommercials(): Collection
    {
        return $this->commercials;
    }

    public function addCommercial(Commercial $commercial): self
    {
        if (!$this->commercials->contains($commercial)) {
            $this->commercials[] = $commercial;
            $commercial->setIdAffectedZone($this);
        }

        return $this;
    }

    public function removeCommercial(Commercial $commercial): self
    {
        if ($this->contacts->contains($commercial)) {
            $this->contacts->removeElement($commercial);
            // set the owning side to null (unless already changed)
            if ($commercial->getIdAffectedZone() === $this) {
                $commercial->setIdAffectedZone(null);
            }
        }
        
        return $this;
    }
}
