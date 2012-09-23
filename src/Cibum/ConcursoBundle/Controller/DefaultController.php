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

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CibumConcursoBundle:Default:index.html.twig');
    }
}
