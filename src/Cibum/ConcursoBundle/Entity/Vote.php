<?php

namespace Cibum\ConcursoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cibum\ConcursoBundle\Entity\Vote
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Cibum\ConcursoBundle\Entity\VoteRepository")
 */
class Vote
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $user
     *
     * @ORM\Column(name="user", type="string", length=255)
     */
    private $user;

    /**
     * @var string $project
     *
     * @ORM\Column(name="project", type="string", length=255)
     */
    private $project;

    /**
     * @var boolean $vote
     *
     * @ORM\Column(name="vote", type="boolean")
     */
    private $vote;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param string $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return string 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set project
     *
     * @param string $project
     */
    public function setProject($project)
    {
        $this->project = $project;
    }

    /**
     * Get project
     *
     * @return string 
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set vote
     *
     * @param boolean $vote
     */
    public function setVote($vote)
    {
        $this->vote = $vote;
    }

    /**
     * Get vote
     *
     * @return boolean 
     */
    public function getVote()
    {
        return $this->vote;
    }
}