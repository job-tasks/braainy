<?php

namespace App\Form;

use App\Constant\ContactTypeConstants;
use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class,[
                'choices' => ContactTypeConstants::getChoices()
            ])
            ->add('billyId')
            ->add('organizationId')
            ->add('createdTime', DateTimeType::class)
            ->add('name')
            ->add('countryId')
            ->add('street')
            ->add('cityId')
            ->add('cityText')
            ->add('stateId')
            ->add('stateText')
            ->add('zipcodeId')
            ->add('zipcodeText')
            ->add('contactNo')
            ->add('phone')
            ->add('fax')
            ->add('currencyId')
            ->add('registrationNo')
            ->add('ean')
            ->add('localeId')
            ->add('isCustomer')
            ->add('isSupplier')
            ->add('paymentTermsMode')
            ->add('paymentTermsDays')
            ->add('accessCode')
            ->add('emailAttachmentDeliveryMode')
            ->add('isArchived')
            ->add('isSalesTaxExempt')
            ->add('defaultExpenseProductDescription')
            ->add('defaultExpenseAccountId')
            ->add('defaultTaxRateId')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
