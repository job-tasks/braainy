<?php

namespace App\Service;


use App\Constant\ContactTypeConstants;
use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;

/**
 * Class ContactService.
 */
final class ContactService implements EntityServiceInterface
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
            /** Contact $contact */
            if (!$contact = $this->entityManager->getRepository(Contact::class)->findOneBy([
                'billyId' => $array['id'],
            ])) {
                $contact = new Contact();
            }
            $contact->setBillyId($array['id']);
            $contact->setType(ContactTypeConstants::getChoices()[$array['type']]);
            $contact->setOrganizationId($array['organizationId']);
            $contact->setName($array['name']);
            $contact->setCountryId($array['countryId']);
            $contact->setStreet($array['street']);
            $contact->setCityText($array['cityText']);
            $contact->setStateText($array['stateText']);
            $contact->setZipcodeText($array['zipcodeText']);
            $contact->setContactNo($array['contactNo']);
            $contact->setPhone($array['phone']);
            $contact->setFax($array['fax']);
            $contact->setRegistrationNo($array['registrationNo']);
            $contact->setEan($array['ean']);
            $contact->setIsCustomer($array['isCustomer']);
            $contact->setIsSupplier($array['isSupplier']);
            $contact->setAccessCode($array['accessCode']);
            $contact->setIsArchived($array['isArchived']);
            $contact->setIsSalesTaxExempt($array['isSalesTaxExempt']);
            $contact->setDefaultExpenseProductDescription($array['defaultExpenseProductDescription']);
            $contact->setExternalId($array['externalId']);

            $this->entityManager->persist($contact);
            $this->entityManager->flush();

            return $contact;
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * @param array $array
     * @throws \Exception
     */
    public function sync(array $array)
    {
        try {
            $updatedIds = [];
            foreach ($array as $item) {
                $this->updateOrCreate($item);
                array_push($updatedIds, $item['id']);
            }

            $queryBuilder = $this->entityManager->createQueryBuilder();
            $query = $queryBuilder->delete(Contact::class,'c')->where('c.billyId NOT IN (:updated_ids)')
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
        $query =  $this->entityManager->getRepository(Contact::class)
            ->createQueryBuilder('c')
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

        $array['type'] = ContactTypeConstants::CHOICES[$array['type']];

        return $array;
    }

    /**
     * @param int $id
     * @param string $billyId
     */
    public function updateId(int $id,string $billyId)
    {
        /** @var Contact $contact */
        $contact = $this->entityManager->getRepository(Contact::class)->find($id);
        $contact->setBillyId($billyId);
        $this->entityManager->flush();
    }
}
