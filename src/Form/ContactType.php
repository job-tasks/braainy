<?php

namespace App\Form;

use App\Constant\ContactTypeConstants;
use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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

            ->add('name')
            ->add('street')
            ->add('cityText')
            ->add('stateText')
            ->add('zipcodeText')
            ->add('contactNo')
            ->add('phone')
            ->add('fax')
            ->add('registrationNo')
            ->add('ean')
            ->add('isCustomer')
            ->add('isSupplier')
            ->add('paymentTermsDays')
            ->add('accessCode')
            ->add('isArchived')
            ->add('isSalesTaxExempt')
            ->add('defaultExpenseProductDescription')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
