<?php

namespace Cibum\ConcursoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class FilterForm extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('distrito', 'entity', array(
            'label' => 'Distrito',
            'class' => 'Cibum\ConcursoBundle\Entity\Distrito',
            'property' => 'nombre',
            'required' => false,
        ))
            ->add('anho', 'choice', array(
            'label' => "Año",
            'choices' => array(
                '2012', '2011'
            ),
            'required' => false
        ))

        ;
    }

    public function getName()
    {
        return 'filter';
    }
}
