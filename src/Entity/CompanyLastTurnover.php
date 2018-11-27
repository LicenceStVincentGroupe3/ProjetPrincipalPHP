<?php

namespace App\Entity;

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
}
