<?php

namespace AppBundle\Type;  
 
use Symfony\Component\Form\AbstractType;  
use Symfony\Component\Form\FormBuilderInterface;  
use Symfony\Component\OptionsResolver\OptionsResolver;  
 
class OrderStatusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('statusDateTime')
            ->add('order')
            ->add('status')
        ;
    }
 
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\OrderStatus',
            'csrf_protection' => false
        ));
    }
 
    public function getName()
    {
        return '';
    }
}