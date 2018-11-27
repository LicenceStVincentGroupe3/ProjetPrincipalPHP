<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompanyLastTurnoverRepository")
 */
class CompanyLastTurnover
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $turnover;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Parameter", mappedBy="idCompanyLastTurnover")
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

    public function getTurnover(): ?int
    {
        return $this->turnover;
    }

    public function setTurnover(int $turnover): self
    {
        $this->turnover = $turnover;

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
            $idParameter->setIdCompanyLastTurnover($this);
        }

        return $this;
    }

    public function removeIdParameter(Parameter $idParameter): self
    {
        if ($this->idParameter->contains($idParameter)) {
            $this->idParameter->removeElement($idParameter);
            // set the owning side to null (unless already changed)
            if ($idParameter->getIdCompanyLastTurnover() === $this) {
                $idParameter->setIdCompanyLastTurnover(null);
            }
        }

        return $this;
    }
}
