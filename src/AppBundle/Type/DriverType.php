<?php

namespace AppBundle\Type;  
 
use Symfony\Component\Form\AbstractType;  
use Symfony\Component\Form\FormBuilderInterface;  
use Symfony\Component\OptionsResolver\OptionsResolver;  
 
class DriverType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('username')
            ->add('password', 'password')
        ;
    }
 
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Driver',
            'csrf_protection' => false
        ));
    }
 
    public function getName()
    {
        return '';
    }
}