<?php

namespace App\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\ParameterTargetRepository")
 */
class ParameterTarget
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
    private $parameterTargetTarget;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParameterTargetTarget(): ?string
    {
        return $this->parameterTargetTarget;
    }

    public function setParameterTargetTarget(string $parameterTargetTarget): self
    {
        $this->parameterTargetTarget = $parameterTargetTarget;

        return $this;
    }
}
