<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompanyNbEmployeeRepository")
 */
class CompanyNbEmployee
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
    private $nbEmployee;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbEmployee(): ?int
    {
        return $this->nbEmployee;
    }

    public function setNbEmployee(int $nbEmployee): self
    {
        $this->nbEmployee = $nbEmployee;

        return $this;
    }
}
