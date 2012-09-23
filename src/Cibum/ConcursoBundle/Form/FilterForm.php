<?php

namespace Cibum\ConcursoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class FilterForm extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('district', '');
    }

    public function getName()
    {
        return 'filter';
    }
}
