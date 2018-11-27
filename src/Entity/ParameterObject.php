<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParameterObjectRepository")
 */
class ParameterObject
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
    private $parameterObjectObject;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParameterObjectObject(): ?string
    {
        return $this->parameterObjectObject;
    }

    public function setParameterObjectObject(string $parameterObjectObject): self
    {
        $this->parameterObjectObject = $parameterObjectObject;

        return $this;
    }
}
