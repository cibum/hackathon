<?php

namespace Cibum\ConcursoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Doctrine\ORM\EntityRepository;

class FilterForm extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('distrito', 'entity', array(
            'label' => 'Distrito',
            'class' => 'Cibum\ConcursoBundle\Entity\Distrito',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('d')
                    ->orderBy('d.nombre', 'ASC');
            },
            'property' => 'nombre',
            'required' => false,
        ))
            ->add('anho', 'choice', array(
            'label' => "Año",
            'choices' => array(
                '2012' => '2012',
                '2011' => '2011',
            ),
            'required' => true
        ));
    }

    public function getName()
    {
        return 'filter';
    }
}
