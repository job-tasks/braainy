<?php

namespace App\Service;


use App\Constant\ContactTypeConstants;
use App\Entity\Contact;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ProductService.
 */
final class ProductService implements EntityServiceInterface
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * ContactService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param array $array
     * @return Contact|object|null
     * @throws \Exception
     */
    public function getOrCreate(array $array)
    {
        try {
            if ($product = $this->entityManager->getRepository(Product::class)->findOneBy([
                'billyId' => $array['id'],
            ])) {
                return $product;
            }

            $product = new Product();
            $product->setBillyId($array['id']);
            $product->setOrganizationId($array['organizationId']);
            $product->setName($array['name']);
            $product->setExternalId($array['externalId']);
            $product->setDescription($array['description']);
            $product->setAccountId($array['accountId']);
            $product->setInventoryAccountId($array['inventoryAccountId']);
            $product->setProductNo($array['productNo']);
            $product->setSuppliersProductNo($array['suppliersProductNo']);
            $product->setSalesTaxRulesetId($array['salesTaxRulesetId']);
            $product->setIsArchived($array['isArchived']);
            $product->setIsInInventory($array['isInInventory']);
            $product->setImageId($array['imageId']);
            $product->setImageUrl($array['imageUrl']);

            $this->entityManager->persist($product);
            $this->entityManager->flush();

            return $product;
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }
}
