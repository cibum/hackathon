<?php

namespace Cibum\ConcursoBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ProyectoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProyectoRepository extends EntityRepository
{

    /**
     * returns the list of projects
     *
     * @param array $list
     * @return array
     */
    public function findNew(array $list)
    {
        return $this->getEntityManager()->createQuery('SELECT p.snip FROM CibumConcursoBundle:Proyecto p WHERE p.snip IN :list')
            ->setParameter('list', $list)
            ->getArrayResult();
    }


    /**
     * Returns all snip codes in the db
     *
     * @return array
     */
    public function getAllQuick()
    {
        $ans = $this->getEntityManager()->createQuery("SELECT CONCAT(CONCAT(a.anho, ':'), p.snip) FROM CibumConcursoBundle:Proyecto p JOIN p.anuales a")
            ->getArrayResult();
        return array_map(function ($item) {
            return $item[1];
        }, $ans);
    }

    public function findByFilter(array $criteria)
	{
	}

    public function getBySnips($snips)
    {
        return $this->getEntityManager()->createQuery('SELECT p FROM CibumConcursoBundle:Proyecto p WHERE p.snip IN :snips')
        ->setParameter('snips', $snips)
        ->getResult();
    }

}