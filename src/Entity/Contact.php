<?php

namespace App\Entity;

use App\Constant\ContactTypeConstants;
use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="contacts")
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
class Contact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $billyId;

    /**
     * @ORM\Column(type="integer"))
     */
    private $type = ContactTypeConstants::COMPANY;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $organizationId;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdTime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $countryId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cityId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cityText;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $stateId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $stateText;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $zipcodeId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $zipcodeText;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contactNo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fax;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $currencyId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $registrationNo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ean;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $localeId;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isCustomer;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isSupplier;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $paymentTermsMode;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $paymentTermsDays;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $accessCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $emailAttachmentDeliveryMode;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isArchived;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isSalesTaxExempt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $defaultExpenseProductDescription;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $defaultExpenseAccountId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $defaultTaxRateId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $externalId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBillyId(): ?string
    {
        return $this->billyId;
    }

    public function setBillyId(string $billyId): self
    {
        $this->billyId = $billyId;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getOrganizationId(): ?string
    {
        return $this->organizationId;
    }

    public function setOrganizationId(string $organizationId): self
    {
        $this->organizationId = $organizationId;

        return $this;
    }

    public function getCreatedTime(): ?\DateTimeInterface
    {
        return $this->createdTime;
    }

    public function setCreatedTime(?\DateTimeInterface $createdTime): self
    {
        $this->createdTime = $createdTime;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCountryId(): ?string
    {
        return $this->countryId;
    }

    public function setCountryId(string $countryId): self
    {
        $this->countryId = $countryId;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getCityId(): ?string
    {
        return $this->cityId;
    }

    public function setCityId(?string $cityId): self
    {
        $this->cityId = $cityId;

        return $this;
    }

    public function getCityText(): ?string
    {
        return $this->cityText;
    }

    public function setCityText(?string $cityText): self
    {
        $this->cityText = $cityText;

        return $this;
    }

    public function getStateId(): ?string
    {
        return $this->stateId;
    }

    public function setStateId(?string $stateId): self
    {
        $this->stateId = $stateId;

        return $this;
    }

    public function getStateText(): ?string
    {
        return $this->stateText;
    }

    public function setStateText(?string $stateText): self
    {
        $this->stateText = $stateText;

        return $this;
    }

    public function getZipcodeId(): ?string
    {
        return $this->zipcodeId;
    }

    public function setZipcodeId(?string $zipcodeId): self
    {
        $this->zipcodeId = $zipcodeId;

        return $this;
    }

    public function getZipcodeText(): ?string
    {
        return $this->zipcodeText;
    }

    public function setZipcodeText(?string $zipcodeText): self
    {
        $this->zipcodeText = $zipcodeText;

        return $this;
    }

    public function getContactNo(): ?string
    {
        return $this->contactNo;
    }

    public function setContactNo(?string $contactNo): self
    {
        $this->contactNo = $contactNo;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(?string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function getCurrencyId(): ?string
    {
        return $this->currencyId;
    }

    public function setCurrencyId(?string $currencyId): self
    {
        $this->currencyId = $currencyId;

        return $this;
    }

    public function getRegistrationNo(): ?string
    {
        return $this->registrationNo;
    }

    public function setRegistrationNo(?string $registrationNo): self
    {
        $this->registrationNo = $registrationNo;

        return $this;
    }

    public function getEan(): ?string
    {
        return $this->ean;
    }

    public function setEan(?string $ean): self
    {
        $this->ean = $ean;

        return $this;
    }

    public function getLocaleId(): ?string
    {
        return $this->localeId;
    }

    public function setLocaleId(?string $localeId): self
    {
        $this->localeId = $localeId;

        return $this;
    }

    public function getIsCustomer(): ?bool
    {
        return $this->isCustomer;
    }

    public function setIsCustomer(bool $isCustomer): self
    {
        $this->isCustomer = $isCustomer;

        return $this;
    }

    public function getIsSupplier(): ?bool
    {
        return $this->isSupplier;
    }

    public function setIsSupplier(bool $isSupplier): self
    {
        $this->isSupplier = $isSupplier;

        return $this;
    }

    public function getPaymentTermsMode(): ?string
    {
        return $this->paymentTermsMode;
    }

    public function setPaymentTermsMode(?string $paymentTermsMode): self
    {
        $this->paymentTermsMode = $paymentTermsMode;

        return $this;
    }

    public function getPaymentTermsDays(): ?int
    {
        return $this->paymentTermsDays;
    }

    public function setPaymentTermsDays(?int $paymentTermsDays): self
    {
        $this->paymentTermsDays = $paymentTermsDays;

        return $this;
    }

    public function getAccessCode(): ?string
    {
        return $this->accessCode;
    }

    public function setAccessCode(?string $accessCode): self
    {
        $this->accessCode = $accessCode;

        return $this;
    }

    public function getEmailAttachmentDeliveryMode(): ?string
    {
        return $this->emailAttachmentDeliveryMode;
    }

    public function setEmailAttachmentDeliveryMode(?string $emailAttachmentDeliveryMode): self
    {
        $this->emailAttachmentDeliveryMode = $emailAttachmentDeliveryMode;

        return $this;
    }

    public function getIsArchived(): ?bool
    {
        return $this->isArchived;
    }

    public function setIsArchived(bool $isArchived): self
    {
        $this->isArchived = $isArchived;

        return $this;
    }

    public function getIsSalesTaxExempt(): ?bool
    {
        return $this->isSalesTaxExempt;
    }

    public function setIsSalesTaxExempt(bool $isSalesTaxExempt): self
    {
        $this->isSalesTaxExempt = $isSalesTaxExempt;

        return $this;
    }

    public function getDefaultExpenseProductDescription(): ?string
    {
        return $this->defaultExpenseProductDescription;
    }

    public function setDefaultExpenseProductDescription(?string $defaultExpenseProductDescription): self
    {
        $this->defaultExpenseProductDescription = $defaultExpenseProductDescription;

        return $this;
    }

    public function getDefaultExpenseAccountId(): ?string
    {
        return $this->defaultExpenseAccountId;
    }

    public function setDefaultExpenseAccountId(?string $defaultExpenseAccountId): self
    {
        $this->defaultExpenseAccountId = $defaultExpenseAccountId;

        return $this;
    }

    public function getDefaultTaxRateId(): ?string
    {
        return $this->defaultTaxRateId;
    }

    public function setDefaultTaxRateId(?string $defaultTaxRateId): self
    {
        $this->defaultTaxRateId = $defaultTaxRateId;

        return $this;
    }

    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    public function setExternalId(?string $externalId): self
    {
        $this->externalId = $externalId;

        return $this;
    }
}
