<?php
namespace Cibum\ConcursoBundle\Updater;

use Doctrine\ORM\EntityManager;
use Cibum\ConcursoBundle\Entity\Proyecto;
use Cibum\ConcursoBundle\Entity\ProyectoRepository;
use Cibum\ConcursoBundle\Entity\Anual;
use Socrata;

class Updater
{
    /** @var $em \Doctrine\ORM\EntityManager */
    private $em;

    function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function batchUpdate()
    {
        $socrata = new Socrata('https://opendata.socrata.com/api');

        //pull data
        $data = $socrata->get('/views/h3ut-rsd9/rows.json', array('meta' => 'false'))['data'];

        $datasimple = array();
        foreach ($data as $row) {
            if ($row[11] != "")
                $datasimple[] = $row[8] . ':' . $row[11];
        }

        /** @var $repo ProyectoRepository */
        $repo = $this->em->getRepository('CibumConcursoBundle:Proyecto');

        $actualproj = $repo->getAllQuick();
        $new = array_diff($datasimple, $actualproj);

        $datavalid = array();
        $i = 0;
        foreach ($data as $row) {
            $pair = $row[8] . ':' . $row[11];
            if ($pair === $new[$i]) {
                $datavalid[] = $row;
                $i++;
            }
        }

        //\Doctrine\Common\Util\Debug::dump($datavalid, 5);
        //die;

        foreach ($new as $each) {
            // obtener cada proyecto
            $fila = array();

            $proyecto = new Proyecto();
            $proyecto->setNombre($fila[0]->getNombre());
            $proyecto->setDescripcion($fila[0]->getDescripcion());
            $proyecto->setSnip($fila[0]->getSnip());


            foreach ($fila as $anual) {
                $anho = new Anual();
                $anho->setAnho($anual->getAnho());
                $anho->setAvance($anual->getAvance());

                foreach ($anho->getDistritos() as $distrito) {
                    $distrito = $this->em->getRepository('CibumConcursoBundle:Distrito')->findBy(array('nombre' => $distrito));
                    $anho->addDistrito($distrito);
                }

                $proyecto->addAnual($anho);
            }
        }
    }

    public function updateOne($project)
    {

    }

}
