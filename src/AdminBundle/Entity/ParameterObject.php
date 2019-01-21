<?php

namespace App\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


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
     * @Assert\NotBlank
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
