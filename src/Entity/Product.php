<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="products")
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
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
     * @ORM\Column(type="string", length=255)
     */
    private $organizationId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $accountId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $productNo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $suppliersProductNo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $salesTaxRulesetId;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isArchived = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isInInventory = false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageUrl;

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

    public function getOrganizationId(): ?string
    {
        return $this->organizationId;
    }

    public function setOrganizationId(string $organizationId): self
    {
        $this->organizationId = $organizationId;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAccountId(): ?string
    {
        return $this->accountId;
    }

    public function setAccountId(string $accountId): self
    {
        $this->accountId = $accountId;

        return $this;
    }

    public function getProductNo(): ?string
    {
        return $this->productNo;
    }

    public function setProductNo(?string $productNo): self
    {
        $this->productNo = $productNo;

        return $this;
    }

    public function getSuppliersProductNo(): ?string
    {
        return $this->suppliersProductNo;
    }

    public function setSuppliersProductNo(?string $suppliersProductNo): self
    {
        $this->suppliersProductNo = $suppliersProductNo;

        return $this;
    }

    public function getSalesTaxRulesetId(): ?string
    {
        return $this->salesTaxRulesetId;
    }

    public function setSalesTaxRulesetId(string $salesTaxRulesetId): self
    {
        $this->salesTaxRulesetId = $salesTaxRulesetId;

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

    public function getIsInInventory(): ?bool
    {
        return $this->isInInventory;
    }

    public function setIsInInventory(bool $isInInventory): self
    {
        $this->isInInventory = $isInInventory;

        return $this;
    }

    public function getImageId(): ?string
    {
        return $this->imageId;
    }

    public function setImageId(?string $imageId): self
    {
        $this->imageId = $imageId;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

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
