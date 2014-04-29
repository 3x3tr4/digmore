<?php

namespace Digmore\DeviceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DeviceType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('minerId')
            ->add('name')
            ->add('intensity')
            ->add('gap')
            ->add('wsize')
            ->add('vectors')
            ->add('tc')
            ->add('shaders')
            ->add('freqDevice')
            ->add('freqMemory')
            ->add('powertune')
            ->add('tempCut')
            ->add('tempMax')
            ->add('tempMin')
            ->add('fanMin')
            ->add('fanMax')
            ->add('threads')
            ->add('new')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Digmore\DeviceBundle\Entity\Device'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'digmore_device';
    }
}
