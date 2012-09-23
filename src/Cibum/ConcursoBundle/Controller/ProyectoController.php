<?php

namespace Cibum\ConcursoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/admin/proyectos")
 */
class ProyectoController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction($name)
    {
        $em = $this->getDoctrine();
        return array();
    }
}
