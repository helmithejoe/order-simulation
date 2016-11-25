<?php

namespace AppBundle\Type;  
 
use Symfony\Component\Form\AbstractType;  
use Symfony\Component\Form\FormBuilderInterface;  
use Symfony\Component\OptionsResolver\OptionsResolver;  
 
class ItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('sku')
            ->add('name')
            ->add('description')
            ->add('price')
        ;
    }
 
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Item',
            'csrf_protection' => false
        ));
    }
 
    public function getName()
    {
        return '';
    }
}