<?php

namespace Cibum\ConcursoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cibum\ConcursoBundle\Form\FilterForm;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Cibum\ConcursoBundle\Entity\Vote;
use Cibum\ConcursoBundle\Entity\Comment;
use Cibum\ConcursoBundle\Form\CommentType;

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

//        $filter = $session->get('project_filter', array());
        $filter = array();

        $filter_form = $this->createForm(new FilterForm(), $filter);

        if ($request->getMethod() === 'POST') {
            $filter_form->bindRequest($request);

            if ($filter_form->isValid()) {
                $filter = $filter_form->getData();
                $session->set('project_filter', $filter);
            }
        }

        $proyectos = $this->getDoctrine()->getRepository('Cibum\ConcursoBundle\Entity\Proyecto')->findByFilter($filter);

        return array(
            'proyectos' => $proyectos,
            'filter' => $filter_form->createView(),
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

        if (!$proyecto) {
            return $this->createNotFoundException();
        }

        $comment = new \Cibum\ConcursoBundle\Entity\Comment();
        $commentForm = $this->createForm(new CommentType(), $comment);

        $comments = $this->getDoctrine()->getRepository('CibumConcursoBundle:Comment')->forProject($proyecto);

        return array(
            'proyecto' => $proyecto,
            'comments' => $comments,
            'commentForm' => $commentForm->createView(),

        );
    }

    /**
     * @Route("/project/{proyecto}/comment", name="project_comment")
     * @Template("CibumConcursoBundle:Project:show.html.twig")
     * @Method("POST")
     */
    public function commentAction($proyecto)
    {
        $proyecto = $this->getDoctrine()->getRepository('Cibum\ConcursoBundle\Entity\Proyecto')->findOneBy(array(
            'id' => $proyecto,
        ));

        if (!$proyecto) {
            return $this->createNotFoundException();
        }

        $comment = new \Cibum\ConcursoBundle\Entity\Comment();
        $commentForm = $this->createForm(new CommentType(), $comment);

        $commentForm->bindRequest($this->getRequest());
        if ($commentForm->isValid()) {
            $user = $this->get('security.context')->getToken()->getUser();
            if ($user instanceof \Symfony\Component\Security\Core\User\UserInterface) {
                $comment->setUser($user);
                $comment->setProject($proyecto);

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($comment);
                $em->flush();
                $this->getRequest()->getSession()->setFlash('success', 'Comentario enviado con éxito');
                return $this->redirect('project_show', array('proyecto', $proyecto->getId()));
            }
            $this->getRequest()->getSession()->setFlash('warning', 'Usuario no registrado');
        }

        $comments = $this->getDoctrine()->getRepository('CibumConcursoBundle:Comment')->forProject($proyecto);

        return array(
            'proyecto' => $proyecto,
            'comments' => $comments,
            'commentForm' => $commentForm->createView(),
        );
    }

    /**
     * @Route("/vote/", name="project_vote")
     * @Method("POST")
     */
    public function voteAction()
    {
        $request = $this->get('request');
        $proyecto = $request->request->get('project');
        $vote = (int)$request->request->get('vote');
        $proyecto = $this->getDoctrine()->getRepository('Cibum\ConcursoBundle\Entity\Proyecto')->findOneBy(array(
            'id' => $proyecto
        ));
        if (!$proyecto)
            return $this->createNotFoundException();

        $user = $this->get("security.context")->getToken()->getUser();
        if($user instanceof \Symfony\Component\Security\Core\User\UserInterface) {
            $vote = new Vote();
            $vote->setUser($user);
            $vote->setProject($proyecto);
            $vote->setVote((bool) $vote);
        }
        else
            return new Response('Debe iniciar sesión para votar', '401');

    }


}
