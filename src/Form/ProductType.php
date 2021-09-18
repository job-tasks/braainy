<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('billyId')
            ->add('organizationId')
            ->add('name')
            ->add('description')
            ->add('accountId')
            ->add('productNo')
            ->add('suppliersProductNo')
            ->add('salesTaxRulesetId')
            ->add('isArchived')
            ->add('isInInventory')
            ->add('imageId')
            ->add('imageUrl')
            ->add('externalId')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
