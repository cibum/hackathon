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

        $filter = array();

        $filter_form = $this->createForm(new FilterForm(), $filter);

        if ($request->getMethod() === 'POST') {
            $filter_form->bindRequest($request);

            if ($filter_form->isValid()) {
                $filter = $filter_form->getData();
            }
        }

        $repo = $this->getDoctrine()->getRepository('Cibum\ConcursoBundle\Entity\Proyecto');

        if (!isset($filter['distrito'])) {
            $repodis = $this->getDoctrine()->getRepository('Cibum\ConcursoBundle\Entity\Distrito');
            $distrito = $repodis->findOneBy(array('nombre' => 'LIMA'));
        } else {
            $distrito = $filter['distrito'];
        }
        $proyectos = $repo->findByFilter($distrito, isset($filter['anho']) ? $filter['anho'] : '2012');

        foreach ($proyectos as $key => $proyecto) {
            $proyectos[$key] = array_merge($proyecto, array('route' => $this->get('router')->generate('project_show', array('proyecto' => $proyecto['id']))));
        }

        return array(
            'proyectos' => json_encode($proyectos),
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

        $votesrepo = $this->getDoctrine()->getRepository('CibumConcursoBundle:Vote');
        $tsup = $votesrepo->getVotes($proyecto, true);
        $tsdown = $votesrepo->getVotes($proyecto, false);
        if ($tsup + $tsdown) {
            $perup = (int)(100 * $tsup / ($tsup + $tsdown));
            $perdown = 100 - $perup;
        } else
            $perup = $perdown = 0;

        return array(
            'proyecto' => $proyecto,
            'comments' => $comments,
            'commentForm' => $commentForm->createView(),
            'tsup' => $tsup,
            'tsdown' => $tsdown,
            'perup' => $perup,
            'perdown' => $perdown
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
        /** @var Proyecto $proyecto */
        if (!$proyecto) {
            return $this->createNotFoundException();
        }

        $comment = new \Cibum\ConcursoBundle\Entity\Comment();
        $commentForm = $this->createForm(new CommentType(), $comment);

        $request = $this->getRequest();
        $commentForm->bindRequest($request);

        if ($commentForm->isValid()) {
            $user = $this->get('security.context')->getToken()->getUser();
            if ($user instanceof \Symfony\Component\Security\Core\User\UserInterface) {
                $comment->setUser($user);
                $comment->setProject($proyecto);

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($comment);
                $em->flush();
                $request->getSession()->setFlash('success', 'Comentario enviado con éxito');
                return $this->redirect($this->generateUrl('project_show', array('proyecto' => $proyecto->getId())));
            }
            $request->getSession()->setFlash('warning', 'Usuario no registrado');
        }

        $comments = $this->getDoctrine()->getRepository('CibumConcursoBundle:Comment')->forProject($proyecto);

        $votesrepo = $this->getDoctrine()->getRepository('CibumConcursoBundle:Vote');
        $tsup = $votesrepo->getVotes($proyecto, true);
        $tsdown = $votesrepo->getVotes($proyecto, false);
        if ($tsup + $tsdown) {
            $perup = (int)(100 * $tsup / ($tsup + $tsdown));
            $perdown = 100 - $perup;
        } else
            $perup = $perdown = 0;

        return array(
            'proyecto' => $proyecto,
            'comments' => $comments,
            'commentForm' => $commentForm->createView(),
            'tsup' => $tsup,
            'tsdown' => $tsdown,
            'perup' => $perup,
            'perdown' => $perdown
        );
    }

    /**
     * @Route("/vote", name="project_vote")
     * @Method("POST")
     */
    public function voteAction()
    {
        $request = $this->get('request');
        $proyecto = $request->request->get('project');
        $votevar = $request->request->get('vote');

        $proyecto = $this->getDoctrine()->getRepository('Cibum\ConcursoBundle\Entity\Proyecto')->findOneBy(array(
            'snip' => $proyecto
        ));
        /** @var Proyecto $proyecto */
        if (!$proyecto)
            return $this->createNotFoundException();

        $user = $this->get("security.context")->getToken()->getUser();

        if ($user instanceof \Symfony\Component\Security\Core\User\UserInterface) {
            $em = $this->getDoctrine()->getEntityManager();
            $vote = $this->getDoctrine()->getRepository('CibumConcursoBundle:Vote')->getVote($user, $proyecto);

            if (!$vote) {
                $vote = new Vote();
                $vote->setUser($user);
                $vote->setProject($proyecto);
            }
            $vote->setVote(!!$votevar);
            $em->persist($vote);
            $em->flush();

            $votesrepo = $this->getDoctrine()->getRepository('CibumConcursoBundle:Vote');
            $tsup = $votesrepo->getVotes($proyecto, true);
            $tsdown = $votesrepo->getVotes($proyecto, false);
            if ($tsup + $tsdown) {
                $perup = (int)(100 * $tsup / ($tsup + $tsdown));
                $perdown = 100 - $perup;
            } else
                $perup = $perdown = 0;
            $response = array(
                'tsup' => $tsup,
                'tsdown' => $tsdown,
                'perup' => $perup,
                'perdown' => $perdown
            );
            return new Response(json_encode($response), 200, array('Content-type' => 'application/json'));
        }
        return new Response('Debe iniciar sesión para votar', 401);
    }
}
