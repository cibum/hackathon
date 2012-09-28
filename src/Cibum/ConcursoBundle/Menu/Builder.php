<?php
namespace Cibum\ConcursoBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root', array(
            'childrenAttributes' => array(
                'class' => 'nav',
            ),
        ));

        $menu->setCurrentUri($this->container->get('request')->getRequestUri());

        $menu->addChild('Inicio', array('route' => 'homepage'));
        $menu->addChild('Sobre Nosotros', array('route' => 'aboutus'));

        return $menu;
    }

    public function userMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root', array(
            'childrenAttributes' => array(
                'class' => 'nav pull-right',
            ),
        ));

        $menu->setCurrentUri($this->container->get('request')->getRequestUri());

        if ($this->container->get('security.context')->isGranted('ROLE_USER')) {
            $menu->addChild('Salir', array('route' => 'fos_user_security_logout'));
        } else {
            $menu->addChild('Regístrate', array('route' => 'fos_user_registration_register'));
            $menu->addChild('Ingresa', array('route' => 'fos_user_security_login'));
        }

        return $menu;
    }
}