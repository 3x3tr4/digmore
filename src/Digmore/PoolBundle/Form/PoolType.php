<?php

namespace Digmore\PoolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PoolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$builder->add('email', 'email');
        //$builder->add('message', 'textarea');
    }

    public function getName()
    {
        return 'digmore_pool';
    }
}
