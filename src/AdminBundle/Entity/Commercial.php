<?php

namespace App\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @UniqueEntity(fields="email")
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\CommercialRepository")
 */
class Commercial implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $commercialCode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $commercialName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $commercialFirstname;

    /**
     * @ORM\Column(type="boolean")
     */
    private $commercialSexe;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $commercialProfil;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime
     */
    private $commercialPlugCreation;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime
     */
    private $commercialLastUpdate;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $commercialStatus;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $commercialBirthday;

    /**
     * @ORM\Column(type="string", length=14, nullable=true)
     */
    private $commercialPhone;

    /**
     * @ORM\Column(type="string", length=14, nullable=true)
     */
    private $commercialMobilePhone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commercialLinkedinAddress;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commercialPhoto;

    /**
     * @ORM\OneToMany(targetEntity="App\AdminBundle\Entity\Contact", mappedBy="idUser")
     */
    private $contacts;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=250)
     */
    private $plainPassword;

    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     *
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(name="roles", type="array")
     */
    private $roles = [];

    public function __construct()
    {
        // Par défaut, la date de création de la fiche commercial est la date d'aujourd'hui
        $this->commercialPlugCreation = new \DateTime();

        $this->commercialStatus = true;

        $this->contacts = new ArrayCollection();
        $this->companies = new ArrayCollection();
    }
  
    /** 
     * @ORM\OneToMany(targetEntity="App\AdminBundle\Entity\Company", mappedBy="idUser")
     */
    private $companies;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommercialCode(): ?string
    {
        return $this->commercialCode;
    }

    public function setCommercialCode(string $commercialCode): self
    {
        $this->commercialCode = $commercialCode;

        return $this;
    }

    public function getCommercialName(): ?string
    {
        return $this->commercialName;
    }

    public function setCommercialName(string $commercialName): self
    {
        $this->commercialName = $commercialName;

        return $this;
    }

    public function getCommercialFirstname(): ?string
    {
        return $this->commercialFirstname;
    }

    public function setCommercialFirstname(string $commercialFirstname): self
    {
        $this->commercialFirstname = $commercialFirstname;

        return $this;
    }

    public function getCommercialSexe(): ?bool
    {
        return $this->commercialSexe;
    }

    public function setCommercialSexe(bool $commercialSexe): self
    {
        $this->commercialSexe = $commercialSexe;

        return $this;
    }

    public function getCommercialProfil(): ?string
    {
        return $this->commercialProfil;
    }

    public function setCommercialProfil(string $commercialProfil): self
    {
        $this->commercialProfil = $commercialProfil;

        return $this;
    }

    public function getCommercialPlugCreation(): ?\DateTimeInterface
    {
        return $this->commercialPlugCreation;
    }

    public function setCommercialPlugCreation(\DateTimeInterface $commercialPlugCreation): self
    {
        $this->commercialPlugCreation = $commercialPlugCreation;

        return $this;
    }

    public function getCommercialLastUpdate(): ?\DateTimeInterface
    {
        return $this->commercialLastUpdate;
    }

    public function setCommercialLastUpdate(\DateTimeInterface $commercialLastUpdate): self
    {
        $this->commercialLastUpdate = $commercialLastUpdate;

        return $this;
    }

    public function getCommercialStatus(): ?bool
    {
        return $this->commercialStatus;
    }

    public function setCommercialStatus(?bool $commercialStatus): self
    {
        $this->commercialStatus = $commercialStatus;

        return $this;
    }

    public function getCommercialBirthday(): ?\DateTimeInterface
    {
        return $this->commercialBirthday;
    }

    public function setCommercialBirthday(?\DateTimeInterface $commercialBirthday): self
    {
        $this->commercialBirthday = $commercialBirthday;

        return $this;
    }

    public function getCommercialPhone(): ?string
    {
        return $this->commercialPhone;
    }

    public function setCommercialPhone(?string $commercialPhone): self
    {
        $this->commercialPhone = $commercialPhone;

        return $this;
    }

    public function getCommercialMobilePhone(): ?string
    {
        return $this->commercialMobilePhone;
    }

    public function setCommercialMobilePhone(?string $commercialMobilePhone): self
    {
        $this->commercialMobilePhone = $commercialMobilePhone;

        return $this;
    }

    public function getCommercialLinkedinAddress(): ?string
    {
        return $this->commercialLinkedinAddress;
    }

    public function setCommercialLinkedinAddress(?string $commercialLinkedinAddress): self
    {
        $this->commercialLinkedinAddress = $commercialLinkedinAddress;

        return $this;
    }

    public function getCommercialPhoto(): ?string
    {
        return $this->commercialPhoto;
    }

    public function setCommercialPhoto(?string $commercialPhoto): self
    {
        $this->commercialPhoto = $commercialPhoto;

        return $this;
    }



    public function getUsername() {
        return $this->email;
    }

    public function getSalt() {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getPassword() {
        return $this->password;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    public function getRoles() {
        if (empty($this->roles)) {
            return ['ROLE_COMMERCIAL'];
        }
        return $this->roles;
    }

    function addRole($role) {
        $this->roles[] = $role;
    }

    public function eraseCredentials() {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /** @see \Serializable::serialize() */
    public function serialize() {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized) {
        list (
            $this->id,
            $this->email,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }

    function getEmail() {
        return $this->email;
    }

    function getPlainPassword() {
        return $this->plainPassword;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPlainPassword($plainPassword) {
        $this->plainPassword = $plainPassword;
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
            $contact->setIdUser($this);
        }
    }
  
    /**
     * @return Collection|Company[]
     */
    public function getCompanies(): Collection
    {
        return $this->companies;
    }

    public function addCompany(Company $company): self
    {
        if (!$this->companies->contains($company)) {
            $this->companies[] = $company;
            $company->setIdUser($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->contains($contact)) {
            $this->contacts->removeElement($contact);
            // set the owning side to null (unless already changed)
            if ($contact->getIdUser() === $this) {
                $contact->setIdUser(null);
            }
        }
    }
  
    public function removeCompany(Company $company): self
    {
        if ($this->companies->contains($company)) {
            $this->companies->removeElement($company);
            // set the owning side to null (unless already changed)
            if ($company->getIdUser() === $this) {
                $company->setIdUser(null);
            }
        }

        return $this;
    }
}
