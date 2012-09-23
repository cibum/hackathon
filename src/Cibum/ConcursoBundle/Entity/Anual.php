<?php
namespace Cibum\ConcursoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Cibum\ConcursoBundle\Entity\Anual
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Anual
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
     * @var Proyecto $proyecto
     *
     * @ORM\ManyToOne(targetEntity="Proyecto", inversedBy="anuales")
     */
    protected $proyecto;

    /**
     * @var string $anho
     *
     * @ORM\Column(name="anho", type="string", length=4)
     */
    private $anho;

    /**
     * @var integer $estado
     *
     * @ORM\Column(name="estado", type="string", length=30)
     */
    private $estado;

    /**
     * @var $distrito
     *
     *
     * @ORM\ManyToMany(targetEntity="Distrito", mappedBy="anuales")
     */
    private $distritos;

    /**
     * @var integer $presupuesto
     *
     * @ORM\Column(name="presupuesto", type="integer")
     */
    private $presupuesto;

    /**
     * @var integer $pia
     *
     * @ORM\Column(name="pia", type="integer")
     */
    private $pia;

    /**
     * @var integer $pim
     *
     * @ORM\Column(name="pim", type="integer")
     */
    private $pim;

    /**
     * @var integer $ejecucion_acumulada
     *
     * @ORM\Column(name="ejecucion_acumulada", type="float")
     */
    private $ejecucion_acumulada;

    /**
     * @var integer $avance
     *
     * @ORM\Column(name="avance", type="float")
     */
    private $avance;

    function __construct()
    {
        $this->distritos = new ArrayCollection();
    }

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
     * @param \Cibum\ConcursoBundle\Entity\Proyecto $proyecto
     */
    public function setProyecto(Proyecto $proyecto)
    {
        $this->proyecto = $proyecto;
    }

    /**
     * @return \Cibum\ConcursoBundle\Entity\Proyecto
     */
    public function getProyecto()
    {
        return $this->proyecto;
    }

    /**
     * Set anho
     *
     * @param string $anho
     */
    public function setAnho($anho)
    {
        $this->anho = $anho;
    }

    /**
     * Get anho
     *
     * @return string
     */
    public function getAnho()
    {
        return $this->anho;
    }


    /**
     * Set estado
     *
     * @param string $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set distrito
     *
     * @param Distrito[] $distritos
     */
    public function setDistritos($distritos)
    {
        $this->distritos = $distritos;
    }

    public function addDistrito(Distrito $distrito)
    {
        $this->distritos[] = $distrito;
    }

    /**
     * Get distrito
     *
     * @return Distrito[]
     */
    public function getDistritos()
    {
        return $this->distritos;
    }

    /**
     * Set presupuesto
     *
     * @param integer $presupuesto
     */
    public function setPresupuesto($presupuesto)
    {
        $this->presupuesto = $presupuesto;
    }

    /**
     * Get presupuesto
     *
     * @return integer
     */
    public function getPresupuesto()
    {
        return $this->presupuesto;
    }

    /**
     * Set pia
     *
     * @param integer $pia
     */
    public function setPia($pia)
    {
        $this->pia = $pia;
    }

    /**
     * Get pia
     *
     * @return integer
     */
    public function getPia()
    {
        return $this->pia;
    }

    /**
     * Set pim
     *
     * @param integer $pim
     */
    public function setPim($pim)
    {
        $this->pim = $pim;
    }

    /**
     * Get pim
     *
     * @return integer
     */
    public function getPim()
    {
        return $this->pim;
    }

    /**
     * Set ejecucion_acumulada
     *
     * @param integer $ejecucionAcumulada
     */
    public function setEjecucionAcumulada($ejecucionAcumulada)
    {
        $this->ejecucion_acumulada = $ejecucionAcumulada;
    }

    /**
     * Get ejecucion_acumulada
     *
     * @return integer
     */
    public function getEjecucionAcumulada()
    {
        return $this->ejecucion_acumulada;
    }

    /**
     * Set avance
     *
     * @param float $avance
     */
    public function setAvance($avance)
    {
        $this->avance = $avance;
    }

    /**
     * Get avance
     *
     * @return float
     */
    public function getAvance()
    {
        return $this->avance;
    }

}
