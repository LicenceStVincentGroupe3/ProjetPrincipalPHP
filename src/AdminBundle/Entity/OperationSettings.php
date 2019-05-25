<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\OperationSettingsRepository")
 */
class OperationSettings
{
    /**
     * @ORM\Id()
     * @OneToOne(targetEntity="Operations")
     * @JoinColumn(name="operation_settings_code", referencedColumnName="operation_code")
     */
    private $operationSettingsCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $operationSettingsEmailObject;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\File(
     *      maxSize = "1024k",
     *      mimeTypes={ "image/jpeg", "image/png" },
     *      maxSizeMessage = "La photo ne peut dépasser les 1024 Ko soit 1,024 Mo !",
     *      mimeTypesMessage = "Format JPEG ou PNG uniquement"
     * )
     */
    private $operationSettingsEmailVisual;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(max = 255, maxMessage = "Vous ne pouvez pas dépasser 255 caractères")
     */
    private $operationSettingsEmailText;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $operationSettingsEmailLabelBtn;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $operationSettingsTitlePage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\File(
     *      maxSize = "1024k",
     *      mimeTypes={ "image/jpeg", "image/png" },
     *      maxSizeMessage = "La photo ne peut dépasser les 1024 Ko soit 1,024 Mo !",
     *      mimeTypesMessage = "Format JPEG ou PNG uniquement"
     * )
     */
    private $operationSettingsVisualPage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $operationSettingsIntroductionTitle;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(max = 255, maxMessage = "Vous ne pouvez pas dépasser 255 caractères")
     */
    private $operationSettingsIntroductionText;

    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $operationSettingsLabelBtnPage;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $operationSettingsBtnReject;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime
     */
    private $operationSettingsUpdated;

    public function getOperationSettingsCode(): Operations
    {
        return $this->operationSettingsCode;
    }

    public function setOperationSettingsCode(Operations $operationSettingsCode): self
    {
        $this->operationSettingsCode = $operationSettingsCode;

        return $this;
    }

    public function getOperationSettingsEmailObject(): ?string
    {
        return $this->operationSettingsEmailObject;
    }

    public function setOperationSettingsEmailObject(?string $operationSettingsEmailObject): self
    {
        $this->operationSettingsEmailObject = $operationSettingsEmailObject;

        return $this;
    }

    public function getOperationSettingsEmailVisual(): ?string
    {
        return $this->operationSettingsEmailVisual;
    }

    public function setOperationSettingsEmailVisual(?string $operationSettingsEmailVisual): self
    {
        $this->operationSettingsEmailVisual = $operationSettingsEmailVisual;

        return $this;
    }

    public function getOperationSettingsEmailText(): ?string
    {
        return $this->operationSettingsEmailText;
    }

    public function setOperationSettingsEmailText(string $operationSettingsEmailText): self
    {
        $this->operationSettingsEmailText = $operationSettingsEmailText;

        return $this;
    }

    public function getOperationSettingsEmailLabelBtn(): ?string
    {
        return $this->operationSettingsEmailLabelBtn;
    }

    public function setOperationSettingsEmailLabelBtn(string $operationSettingsEmailLabelBtn): self
    {
        $this->operationSettingsEmailLabelBtn = $operationSettingsEmailLabelBtn;

        return $this;
    }

    public function getOperationSettingsTitlePage(): ?string
    {
        return $this->operationSettingsTitlePage;
    }

    public function setOperationSettingsTitlePage(?string $operationSettingsTitlePage): self
    {
        $this->operationSettingsTitlePage = $operationSettingsTitlePage;

        return $this;
    }

    public function getOperationSettingsVisualPage(): ?string
    {
        return $this->operationSettingsVisualPage;
    }

    public function setOperationSettingsVisualPage(?string $operationSettingsVisualPage): self
    {
        $this->operationSettingsVisualPage = $operationSettingsVisualPage;

        return $this;
    }

    public function getOperationSettingsIntroductionTitle(): ?string
    {
        return $this->operationSettingsIntroductionTitle;
    }

    public function setOperationSettingsIntroductionTitle(?string $operationSettingsIntroductionTitle): self
    {
        $this->operationSettingsIntroductionTitle = $operationSettingsIntroductionTitle;

        return $this;
    }

    public function getOperationSettingsIntroductionText(): ?string
    {
        return $this->operationSettingsIntroductionText;
    }

    public function setOperationSettingsIntroductionText(?string $operationSettingsIntroductionText): self
    {
        $this->operationSettingsIntroductionText = $operationSettingsIntroductionText;

        return $this;
    }

    public function getOperationSettingsLabelBtnPage(): ?string
    {
        return $this->operationSettingsLabelBtnPage;
    }

    public function setOperationSettingsLabelBtnPage(?string $operationSettingsLabelBtnPage): self
    {
        $this->operationSettingsLabelBtnPage = $operationSettingsLabelBtnPage;

        return $this;
    }

    public function getOperationSettingsBtnReject(): ?bool
    {
        return $this->operationSettingsBtnReject;
    }

    public function setOperationSettingsBtnReject(bool $operationSettingsBtnReject): self
    {
        $this->operationSettingsBtnReject = $operationSettingsBtnReject;

        return $this;
    }
}
