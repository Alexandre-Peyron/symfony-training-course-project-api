<?php

namespace ApiBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('invoiceDate',  DateTimeType::class, [
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
            ])
            ->add('object', TextType::class)
            ->add('note', TextType::class)
            ->add('terms', TextType::class)
            ->add('footer', TextType::class)
            ->add('amountPaid', TextType::class)
            ->add('client', EntityType::class, [
                'class' => 'ApiBundle\Entity\Client',
                'choice_label' => 'name',
                'multiple' => false,
                // 'expanded' => true,
            ])
            ->add('status', EntityType::class, [
                'class' => 'ApiBundle\Entity\InvoiceStatus',
                'choice_label' => 'name',
                'multiple' => false,
                // 'expanded' => true,
            ])
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ApiBundle\Entity\Invoice',
            'csrf_protection' => false
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'apibundle_invoice';
    }


}
