<?php

namespace AppBundle\Type;  
 
use Symfony\Component\Form\AbstractType;  
use Symfony\Component\Form\FormBuilderInterface;  
use Symfony\Component\OptionsResolver\OptionsResolver;  
 
class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('address')
            ->add('receivedBy')
            ->add('item')
            ->add('user')
            ->add('driver')
        ;
    }
 
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Order',
            'csrf_protection' => false
        ));
    }
 
    public function getName()
    {
        return '';
    }
}