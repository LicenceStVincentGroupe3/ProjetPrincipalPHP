<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParameterGraphicStyleRepository")
 */
class ParameterGraphicStyle
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
    private $parameterGraphicStyleStyle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParameterGraphicStyleStyle(): ?string
    {
        return $this->parameterGraphicStyleStyle;
    }

    public function setParameterGraphicStyleStyle(string $parameterGraphicStyleStyle): self
    {
        $this->parameterGraphicStyleStyle = $parameterGraphicStyleStyle;

        return $this;
    }
}
