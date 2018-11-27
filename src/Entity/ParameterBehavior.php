<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParameterBehaviorRepository")
 */
class ParameterBehavior
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
    private $parameterBehaviorBehavior;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParameterBehaviorBehavior(): ?string
    {
        return $this->parameterBehaviorBehavior;
    }

    public function setParameterBehaviorBehavior(string $parameterBehaviorBehavior): self
    {
        $this->parameterBehaviorBehavior = $parameterBehaviorBehavior;

        return $this;
    }
}
