<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\ParameterGraphicStyleRepository")
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
     * @Assert\NotBlank
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
