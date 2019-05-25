<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\ContactRepository")
 */
class Contact
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
    private $contactCode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $contactLastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $contactFirstName;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Assert\NotBlank     
     */
    private $contactGender;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank
     * @Assert\Type("\DateTime")
     */
    private $contactDatedCreationPlug;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $contactDateUpdatePlug;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $contactStatus;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $contactDecisionLevel;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $contactPoste;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $contactFacebookAddress;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $contactTwitterAddress;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $contactCP;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $contactVille;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $contactBirthDate;

    /**
     * @ORM\Column(type="string", length=14, nullable=true)
     */
    private $contactMobilePhone;

    /**
     * @ORM\Column(type="string", length=255,  nullable=true)
     */
    private $contactDirectLandline;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contactEmail;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $contactPreVerifiedEmail;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $contactVerifiedEmail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contactLinkedinAddress;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contactPhoto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contactSourceOperation;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contactComment;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $contactOptInNewsletterCustomers;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $contactOptInCommercialOffers;

    /**
     * @ORM\ManyToOne(targetEntity="App\AdminBundle\Entity\Commercial", inversedBy="contacts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idUser;

    /**
     * @ORM\ManyToOne(targetEntity="App\AdminBundle\Entity\Company", inversedBy="contacts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCompany;

    /**
     * @ORM\ManyToOne(targetEntity="App\AdminBundle\Entity\ContactJob", inversedBy="contacts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idContactJob;

    public function __construct()
    {
        $this->contactDatedCreationPlug = new \Datetime();
        //$this->$contactDateUpdatePlug = new \Datetime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContactCode(): ?string
    {
        return $this->contactCode;
    }

    public function setContactCode(string $contactCode): self
    {
        $this->contactCode = $contactCode;

        return $this;
    }

    public function getContactLastName(): ?string
    {
        return $this->contactLastName;
    }

    public function setContactLastName(string $contactLastName): self
    {
        $this->contactLastName = $contactLastName;

        return $this;
    }

    public function getContactFirstName(): ?string
    {
        return $this->contactFirstName;
    }

    public function setContactFirstName(string $contactFirstName): self
    {
        $this->contactFirstName = $contactFirstName;

        return $this;
    }

    public function getContactGender(): ?string
    {
        return $this->contactGender;
    }

    public function setContactGender(string $contactGender): self
    {
        $this->contactGender = $contactGender;

        return $this;
    }

    public function getContactDatedCreationPlug(): ?\DateTimeInterface
    {
        return $this->contactDatedCreationPlug;
    }

    public function setContactDatedCreationPlug(\DateTimeInterface $contactDatedCreationPlug): self
    {
        $this->contactDatedCreationPlug = $contactDatedCreationPlug;

        return $this;
    }

    public function getContactDateUpdatePlug(): ?\DateTimeInterface
    {
        return $this->contactDateUpdatePlug;
    }

    public function setContactDateUpdatePlug(\DateTimeInterface $contactDateUpdatePlug): self
    {
        $this->contactDateUpdatePlug = $contactDateUpdatePlug;

        return $this;
    }

    public function getContactStatus(): ?bool
    {
        return $this->contactStatus;
    }

    public function setContactStatus(?bool $contactStatus): self
    {
        $this->contactStatus = $contactStatus;

        return $this;
    }

    public function getContactDecisionLevel(): ?int
    {
        return $this->contactDecisionLevel;
    }

    public function setContactDecisionLevel(?int $contactDecisionLevel): self
    {
        $this->contactDecisionLevel = $contactDecisionLevel;

        return $this;
    }

    public function getContactPoste(): ?string
    {
        return $this->contactPoste;
    }
    public function setContactPoste(?string $contactPoste): self
    {
        $this->contactPoste = $contactPoste;
        return $this;
    }

    public function getContactFacebookAddress(): ?string
    {
        return $this->contactFacebookAddress;
    }
    
    public function setContactFacebookAddress(?string $contactFacebookAddress): self
    {
        $this->contactFacebookAddress = $contactFacebookAddress;
        return $this;
    }
    
    public function getContactTwitterAddress(): ?string
    {
        return $this->contactTwitterAddress;
    }
    
    public function setContactTwitterAddress(?string $contactTwitterAddress): self
    {
        $this->contactTwitterAddress = $contactTwitterAddress;
        return $this;
    }

    public function getContactCP(): ?string
    {
        return $this->contactCP;
    }

    public function setContactCP(?string $contactCP): self
    {
        $this->contactCP = $contactCP;

        return $this;
    }

    public function getContactVille(): ?string
    {
        return $this->contactVille;
    }

    public function setContactVille(?string $contactVille): self
    {
        $this->contactVille = $contactVille;

        return $this;
    }

    public function getContactBirthDate(): ?\DateTimeInterface
    {
        return $this->contactBirthDate;
    }

    public function setContactBirthDate(?\DateTimeInterface $contactBirthDate): self
    {
        $this->contactBirthDate = $contactBirthDate;

        return $this;
    }

    public function getContactMobilePhone(): ?string
    {
        return $this->contactMobilePhone;
    }

    public function setContactMobilePhone(?string $contactMobilePhone): self
    {
        $this->contactMobilePhone = $contactMobilePhone;

        return $this;
    }

    public function getContactDirectLandline(): ?int
    {
        return $this->contactDirectLandline;
    }

    public function setContactDirectLandline(?int $contactDirectLandline): self
    {
        $this->contactDirectLandline = $contactDirectLandline;

        return $this;
    }

    public function getContactEmail(): ?string
    {
        return $this->contactEmail;
    }

    public function setContactEmail(?string $contactEmail): self
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    public function getContactPreVerifiedEmail(): ?bool
    {
        return $this->contactPreVerifiedEmail;
    }

    public function setContactPreVerifiedEmail(?bool $contactPreVerifiedEmail): self
    {
        $this->contactPreVerifiedEmail = $contactPreVerifiedEmail;

        return $this;
    }

    public function getContactVerifiedEmail(): ?bool
    {
        return $this->contactVerifiedEmail;
    }

    public function setContactVerifiedEmail(?bool $contactVerifiedEmail): self
    {
        $this->contactVerifiedEmail = $contactVerifiedEmail;

        return $this;
    }

    public function getContactLinkedinAddress(): ?string
    {
        return $this->contactLinkedinAddress;
    }

    public function setContactLinkedinAddress(?string $contactLinkedinAddress): self
    {
        $this->contactLinkedinAddress = $contactLinkedinAddress;

        return $this;
    }

    public function getContactPhoto(): ?string
    {
        return $this->contactPhoto;
    }

    public function setContactPhoto(?string $contactPhoto): self
    {
        $this->contactPhoto = $contactPhoto;

        return $this;
    }

    public function getContactSourceOperation(): ?string
    {
        return $this->contactSourceOperation;
    }

    public function setContactSourceOperation(?string $contactSourceOperation): self
    {
        $this->contactSourceOperation = $contactSourceOperation;

        return $this;
    }

    public function getContactComment(): ?string
    {
        return $this->contactComment;
    }

    public function setContactComment(?string $contactComment): self
    {
        $this->contactComment = $contactComment;

        return $this;
    }

    public function getContactOptInNewsletterCustomers(): ?bool
    {
        return $this->contactOptInNewsletterCustomers;
    }

    public function setContactOptInNewsletterCustomers(?bool $contactOptInNewsletterCustomers): self
    {
        $this->contactOptInNewsletterCustomers = $contactOptInNewsletterCustomers;

        return $this;
    }

    public function getContactOptInCommercialOffers(): ?bool
    {
        return $this->contactOptInCommercialOffers;
    }

    public function setContactOptInCommercialOffers(?bool $contactOptInCommercialOffers): self
    {
        $this->contactOptInCommercialOffers = $contactOptInCommercialOffers;

        return $this;
    }

    public function getIdUser(): ?Commercial
    {
        return $this->idUser;
    }

    public function setIdUser(?Commercial $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdCompany(): ?Company
    {
        return $this->idCompany;
    }

    public function setIdCompany(?Company $idCompany): self
    {
        $this->idCompany = $idCompany;

        return $this;
    }

    public function getIdContactJob(): ?ContactJob
    {
        return $this->idContactJob;
    }

    public function setIdContactJob(?ContactJob $idContactJob): self
    {
        $this->idContactJob = $idContactJob;

        return $this;
    }
}
