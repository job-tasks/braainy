<?php

namespace App\Service;


use App\Constant\ContactTypeConstants;
use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;

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
    public function getOrCreate(array $array)
    {
        try {
            if ($contact = $this->entityManager->getRepository(Contact::class)->findOneBy([
                'billyId' => $array['id'],
            ])) {
                return $contact;
            }

            $contact = new Contact();
            $contact->setBillyId($array['id']);
            $contact->setType(ContactTypeConstants::getChoices()[$array['type']]);
            $contact->setOrganizationId($array['organizationId']);
            $contact->setCreatedTime((new \DateTime($array['createdTime'])));
            $contact->setName($array['name']);
            $contact->setCountryId($array['countryId']);
            $contact->setStreet($array['street']);
            $contact->setCityId($array['cityId']);
            $contact->setCityText($array['cityText']);
            $contact->setStateId($array['stateId']);
            $contact->setStateText($array['stateText']);
            $contact->setZipcodeId($array['zipcodeId']);
            $contact->setZipcodeText($array['zipcodeText']);
            $contact->setContactNo($array['contactNo']);
            $contact->setPhone($array['phone']);
            $contact->setFax($array['fax']);
            $contact->setCurrencyId($array['currencyId']);
            $contact->setRegistrationNo($array['registrationNo']);
            $contact->setEan($array['ean']);
            $contact->setLocaleId($array['localeId']);
            $contact->setIsCustomer($array['isCustomer']);
            $contact->setIsSupplier($array['isSupplier']);
            $contact->setPaymentTermsMode($array['paymentTermsMode']);
            $contact->setPaymentTermsDays($array['paymentTermsDays']);
            $contact->setAccessCode($array['accessCode']);
            $contact->setEmailAttachmentDeliveryMode($array['emailAttachmentDeliveryMode']);
            $contact->setIsArchived($array['isArchived']);
            $contact->setIsSalesTaxExempt($array['isSalesTaxExempt']);
            $contact->setDefaultExpenseProductDescription($array['defaultExpenseProductDescription']);
            $contact->setDefaultExpenseAccountId($array['defaultExpenseAccountId']);
            $contact->setDefaultTaxRateId($array['defaultTaxRateId']);
            $contact->setExternalId($array['externalId']);

            $this->entityManager->persist($contact);
            $this->entityManager->flush();

            return $contact;
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }
}
