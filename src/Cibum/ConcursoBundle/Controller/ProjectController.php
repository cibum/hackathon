<?php

namespace Cibum\ConcursoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cibum\ConcursoBundle\Form\FilterForm;

class ProjectController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        $filter = $session->get('project_filter', array());

        $filter_form = $this->createForm(new FilterForm(), $filter);

        $filter_form->bindRequest($request);

        if ($filter_form->isValid()) {
            $session->set('project_filter', $filter);
        }

        $proyectos = $this->getDoctrine()->getRepository('Cibum\ConcursoBundle\Entity\Proyecto')->findByFilter($filter);

        return array(
            'proyectos' => $proyectos,
            'filter'    => $filter_form->createView(),
        );
    }

    /**
     * @Route("/project/{proyecto}", name="project_show")
     * @Template()
     */
    public function showAction($proyecto)
    {
        $proyecto = $this->getDoctrine()->getRepository('Cibum\ConcursoBundle\Entity\Proyecto')->findOneBy(array(
            'id' => $proyecto,
        ));

        if (!$proyecto)
            return $this->createNotFoundException();

        return array('proyecto' => $proyecto);
    }


}
