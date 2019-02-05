<?php

namespace App\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank
     */
    private $contactJobName;

    /**
     * @ORM\OneToMany(targetEntity="App\AdminBundle\Entity\Contact", mappedBy="idContactJob")
     */
    private $contacts;

    /**
     * @ORM\ManyToMany(targetEntity="App\AdminBundle\Entity\Participation", mappedBy="idParticipationContact")
     */
    private $participations;

    /**
     * @ORM\ManyToMany(targetEntity="App\AdminBundle\Entity\Parameter", mappedBy="idParameterContactJob")
     */
    private $parameters;

    public function __construct()
    {
        $this->contacts = new ArrayCollection();
        $this->participations = new ArrayCollection();
        $this->parameters = new ArrayCollection();
    }

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

    public function getIdParameter(): ?Parameter
    {
        return $this->idParameter;
    }

    public function setIdParameter(?Parameter $idParameter): self
    {
        $this->idParameter = $idParameter;

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->setIdContactJob($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->contains($contact)) {
            $this->contacts->removeElement($contact);
            // set the owning side to null (unless already changed)
            if ($contact->getIdContactJob() === $this) {
                $contact->setIdContactJob(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Participation[]
     */
    public function getParticipations(): Collection
    {
        return $this->participations;
    }

    public function addParticipation(Participation $participation): self
    {
        if (!$this->participations->contains($participation)) {
            $this->participations[] = $participation;
            $participation->addIdParticipationContact($this);
        }

        return $this;
    }

    public function removeParticipation(Participation $participation): self
    {
        if ($this->participations->contains($participation)) {
            $this->participations->removeElement($participation);
            $participation->removeIdParticipationContact($this);
        }

        return $this;
    }

    /**
     * @return Collection|Parameter[]
     */
    public function getParameters(): Collection
    {
        return $this->parameters;
    }

    public function addParameter(Parameter $parameter): self
    {
        if (!$this->parameters->contains($parameter)) {
            $this->parameters[] = $parameter;
            $parameter->addIdParameterContactJob($this);
        }

        return $this;
    }

    public function removeParameter(Parameter $parameter): self
    {
        if ($this->parameters->contains($parameter)) {
            $this->parameters->removeElement($parameter);
            $parameter->removeIdParameterContactJob($this);
        }

        return $this;
    }
}
