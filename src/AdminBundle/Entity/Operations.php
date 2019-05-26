<?php

namespace App\AdminBundle\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use App\AdminBundle\Entity\Commercial;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\OperationsRepository")
 */
class Operations
{

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank(message = "Ce champ ne peut être vide.")
     * @Assert\Length(max = 10, maxMessage = "Ce code est trop grand. Veuillez ne pas dépasser 10 caractères.")
     */
    private $operationCode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message = "Ce champ ne peut être vide.")
     */
    private $operationName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $operationRevival;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(max = 255, maxMessage = "Vous ne pouvez pas dépasser 255 caractères")
     */
    private $operationComment;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime
     */
    private $operationSendingDate;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime
     */
    private $operationClosingDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime
     */
    private $operationCreated;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime
     */
    private $operationUpdated;

    /**
     * @var \Commercial
     *
     * @ORM\ManyToOne(targetEntity="Commercial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_commercial", referencedColumnName="id")
     * })
     */
    private $author;

    /**
     * @var \Commercial
     *
     * @ORM\ManyToOne(targetEntity="Commercial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="commercial_last_update", referencedColumnName="id")
     * })
     */
    private $commercialLastUpdate;

    /**
     * @OneToOne(targetEntity="OperationForm")
     * @JoinColumn(name="operation_form", referencedColumnName="id")
     */
    protected $operationForm;

    /**
     * @ORM\Column(name="operation_opt_information", type="boolean", nullable=true, options={"default": false})
     */
    protected $operationOptInformation;

    /**
     * @ORM\Column(name="operation_opt_salesOffer", type="boolean", nullable=true, options={"default": false})
     */
    protected $operationOptSalesOffer;

    /**
     * @OneToOne(targetEntity="OperationSettings")
     * @JoinColumn(name="operation_settings", referencedColumnName="operation_settings_code")
     */
    private $operationSettings;

    /**
     * @ORM\Column(type="boolean")
     */
    private $operationSent;

    /**
     * @ORM\Column(type="boolean")
     */
    private $archived;

    public function __construct()
    {
        $this->archived = false;
    }

    public function getOperationName(): ?string
    {
        return $this->operationName;
    }

    public function setOperationName(string $operationName): self
    {
         $this->operationName = $operationName;

         return $this;
    }

    public function getOperationCode(): ?string
    {
        return $this->operationCode;
    }

    public function setOperationCode(string $operationCode): self
    {
         $this->operationCode = $operationCode;

         return $this;
    }
    
    public function getOperationRevival(): ?int
    {
        return $this->operationRevival;
    }

    public function setOperationRevival(?int $operationRevival): self
    {
         $this->operationRevival = $operationRevival;

         return $this;
    }

    public function getOperationCreated(): ?\DateTimeInterface
    {
        return $this->operationCreated;
    }

    public function setOperationCreated(\DateTimeInterface $operationCreated): self
    {
        $this->operationCreated = $operationCreated;

        return $this;
    }

    public function getOperationUpdated(): ?\DateTimeInterface
    {
        return $this->operationUpdated;
    }

    public function setOperationUpdated(\DateTimeInterface $operationUpdated): self
    {
        $this->operationUpdated = $operationUpdated;

        return $this;
    }

    public function getOperationSendingDate(): ?\DateTimeInterface
    {
        return $this->operationSendingDate;
    }

    public function setOperationSendingDate(?\DateTimeInterface $operationSendingDate): self
    {
        $this->operationSendingDate = $operationSendingDate;

        return $this;
    }

    public function getOperationClosingDate(): ?\DateTimeInterface
    {
        return $this->operationClosingDate;
    }

    public function setOperationClosingDate(?\DateTimeInterface $operationClosingDate): self
    {
        $this->operationClosingDate = $operationClosingDate;

        return $this;
    }

    public function getAuthor(): ?Commercial
    {
        return $this->author;
    }

    public function setAuthor(?Commercial $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function removeAuthor(Commercial $author): self
    {
        if ($this->author->contains($author)) {
            $this->author->removeElement($author);

            // set the owning side to null (unless already changed)
            if ($author->getOperations() === $this) {
                $author->getOperations(null);
            }
        }

        return $this;
    }

    public function getOperationComment(): ?string
    {
        return $this->operationComment;
    }

    public function setOperationComment(?string $operationComment): self
    {
        $this->operationComment = $operationComment;

        return $this;
    }

    public function __toString(){
        return $this->operationName;
    }

    /**
     * @return  \Commercial
     */ 
    public function getCommercialLastUpdate()
    {
        return $this->commercialLastUpdate;
    }

    /**
     * @param  \Commercial  $commercialLastUpdate
     * @return  self
     */ 
    public function setCommercialLastUpdate(Commercial $commercialLastUpdate)
    {
        $this->commercialLastUpdate = $commercialLastUpdate;

        return $this;
    }

    public function getOperationForm()
    {
        return $this->operationForm;
    }

    /**
     * @return  self
     */ 
    public function setOperationForm(OperationForm $operationForm)
    {
        $this->operationForm = $operationForm;

        return $this;
    }

    public function getOperationOptInformation(): ?bool
    {
        return $this->operationOptInformation;
    }

    public function setOperationOptInformation(?bool $operationOptInformation): self
    {
        $this->operationOptInformation = $operationOptInformation;

        return $this;
    }

    public function getOperationOptSalesOffer(): ?bool
    {
        return $this->operationOptSalesOffer;
    }

    public function setOperationOptSalesOffer(?bool $operationOptSalesOffer): self
    {
        $this->operationOptSalesOffer = $operationOptSalesOffer;

        return $this;
    }

    public function getOperationSettings()
    {
        return $this->operationSettings;
    }

    /**
     * @return  self
     */ 
    public function setOperationSettings($operationSettings)
    {
        $this->operationSettings = $operationSettings;

        return $this;
    }

    public function getOperationSent(): bool
    {
        return $this->operationSent;
    }

    /**
     * @return  self
     */ 
    public function setOperationSent(bool $operationSent)
    {
        $this->operationSent = $operationSent;

        return $this;
    }

    public function getArchived(): ?bool
    {
        return $this->archived;
    }

    public function setArchived(?bool $archived): self
    {
        $this->archived = $archived;

        return $this;
    }
}
