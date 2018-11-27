<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactJobRepository")
 */
class ContactJob
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
    private $contactJobName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContactJobName(): ?string
    {
        return $this->contactJobName;
    }

    public function setContactJobName(string $contactJobName): self
    {
        $this->contactJobName = $contactJobName;

        return $this;
    }
}
