<?php

namespace Digmore\MinerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MinerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('ip')
            ->add('port')
            ->add('alert')
            ->add('mac')
            ->add('poolLogin')
            ->add('poolPass')
            ->add('poolId')
            ->add('isLocal')
            ->add(
                'isNew',
                null,
                array('required' => false)
            );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Digmore\MinerBundle\Entity\Miner'
        ));
    }

    public function getName()
    {
        return 'digmore_miner';
    }
}
