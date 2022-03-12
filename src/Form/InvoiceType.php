<?php

namespace App\Form;

use App\Entity\Invoice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class InvoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'required' => true,
            ])
            ->add('number', IntegerType::class, [
                'required' => true
            ])
            ->add('customer_id', IntegerType::class, [
                'required' => true
            ])
            ->add('invoice_lines', CollectionType::class, [
                'entry_type' => InvoiceLineType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
                'attr' => [
                    'class' => 'foo',
                    'data-index' => 0
                ]
            ])
            ->add('add_item', ButtonType::class, [
                'label' => 'Add invoice line',
                'attr' => [
                    'class' => 'btn btn-secondary btn-sm add-line',
                ]
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Invoice::class,
        ]);
    }
}
