<?php

namespace App\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\ParameterTypeSiteRepository")
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
     * @Assert\NotBlank
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
