<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParameterTypeSiteRepository")
 */
class ParameterTypeSite
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
    private $parameterTypeSiteLabel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParameterTypeSiteLabel(): ?string
    {
        return $this->parameterTypeSiteLabel;
    }

    public function setParameterTypeSiteLabel(string $parameterTypeSiteLabel): self
    {
        $this->parameterTypeSiteLabel = $parameterTypeSiteLabel;

        return $this;
    }
}
