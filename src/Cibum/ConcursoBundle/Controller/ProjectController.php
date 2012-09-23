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
        $project = new Proyecto();
        $project->setNombre("Metropolitano");
        $project->setDescripcion("Corredor Vial");
        $project->setSnip("1234");
        $project->setSiaf("23213");

        return array('proyecto' => $project);
    }


}
