<?php

namespace App\Service;


use App\Constant\ContactTypeConstants;
use App\Entity\Contact;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;

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
    public function updateOrCreate(array $array)
    {
        try {
            if (!$product = $this->entityManager->getRepository(Product::class)->findOneBy([
                'billyId' => $array['id'],
            ])) {
                $product = new Product();
            }
            $product->setBillyId($array['id']);
            $product->setOrganizationId($array['organizationId']);
            $product->setName($array['name']);
            $product->setExternalId($array['externalId']);
            $product->setDescription($array['description']);
            $product->setAccountId($array['accountId']);
            $product->setSuppliersProductNo($array['suppliersProductNo']);
            $product->setIsArchived($array['isArchived']);

            $this->entityManager->persist($product);
            $this->entityManager->flush();

            return $product;
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    public function sync(array $array)
    {
        try {
            $updatedIds = [];
            foreach ($array as $item) {
                $this->updateOrCreate($item);
                array_push($updatedIds, $item['id']);
            }

            $queryBuilder = $this->entityManager->createQueryBuilder();
            $query = $queryBuilder->delete(Product::class, 'p')->where('p.billyId NOT IN (:updated_ids)')
                ->setParameter(':updated_ids', $updatedIds)->getQuery();
            $query->execute();
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * @return object[]
     */
    public function getAll(): array
    {
        /** @var Query $query */
        $query = $this->entityManager->getRepository(Product::class)
            ->createQueryBuilder('p')
            ->getQuery();

        return $query->getArrayResult();
    }

    /**
     * @param array $array
     * @param false $isNew
     * @return array
     */
    public function prepareArray(array $array, $isNew = false): array
    {
        if($isNew){
            $array['externalId'] = $array['id'];
            unset($array['id']);

        }else{
            $array['id'] = $array['billyId'];
        }
        unset($array['billyId']);

        return $array;
    }

    /**
     * @param int $id
     * @param string $billyId
     */
    public function updateId(int $id,string $billyId)
    {
        /** @var Product $contact */
        $product = $this->entityManager->getRepository(Product::class)->find($id);
        $product->setBillyId($billyId);
        $this->entityManager->flush();
    }
}
