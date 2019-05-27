<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @UniqueEntity(fields="contactEmail", message="Adresse mail déjà existant")
 * @UniqueEntity(fields="contactCode", message="Code du contact déjà existant")
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
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank(message = "Ce champ ne peut être vide.")
     */
    private $contactCode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message = "Ce champ ne peut être vide.")
     */
    private $contactLastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message = "Ce champ ne peut être vide.")
     */
    private $contactFirstName;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Assert\NotBlank(message = "Ce champ ne peut être vide.")
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
    private $contactCP;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Url(message = "Veuillez insérer une URL valide")
     */
    private $contactFacebookAddress;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Url(message = "Veuillez insérer une URL valide")
     */
    private $contactTwitterAddress;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\Type("\DateTime", message = "Date invalide(format requis : DD/MM/YYYY)")
     */
    private $contactBirthDate;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     * @Assert\Length(min = 10, minMessage = "Tel. 10 caractères minimun !")
     * @Assert\Length(max = 10, maxMessage = "Tel. 10 caractères maxnimun !")
     * @Assert\Regex(pattern="/^(\(0\))?[0-9]+$/", message="Format : 0301010101")
     */
    private $contactMobilePhone;

    /**
     * @ORM\Column(type="string", length=10,  nullable=true)
     * @Assert\Length(min = 10, minMessage = "Tel. 10 caractères minimun !")
     * @Assert\Length(max = 10, maxMessage = "Tel. 10 caractères maxnimun !")
     * @Assert\Regex(pattern="/^(\(0\))?[0-9]+$/", message="Format : 0601010101")
     */
    private $contactDirectLandline;

    /**
     * @ORM\Column(type="string", length=10,  nullable=true)
     * @Assert\Length(min = 10, minMessage = "Tel. 10 caractères minimun !")
     * @Assert\Length(max = 10, maxMessage = "Tel. 10 caractères maxnimun !")
     * @Assert\Regex(pattern="/^(\(0\))?[0-9]+$/", message="Format : 0601010101")
     */
    private $contactStandartPhone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email(message = "Veuillez insérer un email valide")
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
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime(message = "Date invalide(format requis : DD/MM/YYYY)")
     */
    private $arrivalDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime(message = "Date invalide(format requis : DD/MM/YYYY)")
     */
    private $departureDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url(message = "Veuillez insérer une URL valide")
     */
    private $contactLinkedinAddress;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\File(
     *      maxSize = "1024k",
     *      mimeTypes={ "image/jpeg", "image/png" },
     *      maxSizeMessage = "La photo ne peut dépasser les 1024 Ko soit 1,024 Mo !",
     *      mimeTypesMessage = "Format JPEG ou PNG uniquement"
     * )
     */
    private $contactPhoto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contactSourceOperation;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(max = 255, maxMessage = "Vous ne pouvez pas dépasser 255 caractères")
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
     * @ORM\JoinColumn(nullable=true)
     */
    private $idUser;

    /**
     * @ORM\OneToOne(targetEntity="App\AdminBundle\Entity\Contact")
     * @ORM\JoinColumn(name="id_contact", referencedColumnName="id", nullable=true)
     */
    private $idContact;

    /**
     * @ORM\ManyToOne(targetEntity="App\AdminBundle\Entity\Company", inversedBy="contacts")
     * @ORM\JoinColumn(nullable=true)
     */
    private $idCompany;

    /**
     * @ORM\ManyToOne(targetEntity="App\AdminBundle\Entity\ContactJob", inversedBy="contacts")
     * @ORM\JoinColumn(nullable=true)
     */
    private $idContactJob;

    public function __construct()
    {
        $this->contactDatedCreationPlug = new \Datetime();
        $this->arrivalDate = new \DateTime();
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

    public function getContactCP(): ?string
    {
        return $this->contactPoste;
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

    public function getContactDirectLandline(): ?string
    {
        return $this->contactDirectLandline;
    }

    public function setContactDirectLandline(?string $contactDirectLandline): self
    {
        $this->contactDirectLandline = $contactDirectLandline;

        return $this;
    }

    public function getContactStandartPhone(): ?string
    {
        return $this->contactStandartPhone;
    }

    public function setContactStandartPhone(?string $contactStandartPhone): self
    {
        $this->contactStandartPhone = $contactStandartPhone;

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

    public function getArrivalDate(): ?\DateTimeInterface
    {
        return $this->arrivalDate;
    }

    public function setArrivalDate(?\DateTimeInterface $arrivalDate): self
    {
        $this->arrivalDate = $arrivalDate;

        return $this;
    }

    public function getDepartureDate(): ?\DateTimeInterface
    {
        return $this->departureDate;
    }

    public function setDepartureDate(?\DateTimeInterface $departureDate): self
    {
        $this->departureDate = $departureDate;

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

    public function getIdContact(): ?Contact
    {
        return $this->idContact;
    }

    public function setIdContact(?Contact $idContact): self
    {
        $this->idContact = $idContact;

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
