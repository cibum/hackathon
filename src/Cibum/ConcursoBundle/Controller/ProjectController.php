<?php

namespace Cibum\ConcursoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cibum\ConcursoBundle\Entity\Proyecto;

class ProjectController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/project/1", name="project_show")
     * @Template()
     */
    public function showAction()
    {
       $project =new Proyecto();
       $project->setNombre("jjujujuju");
       
        return array('proyecto' => $project );
    }
    
    
}
