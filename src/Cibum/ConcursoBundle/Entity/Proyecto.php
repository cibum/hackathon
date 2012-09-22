<?php

namespace Cibum\ConcursoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cibum\ConcursoBundle\Entity\Proyecto
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Cibum\ConcursoBundle\Entity\ProyectoRepository")
 */
class Proyecto
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
     * @var string $anho
     *
     * @ORM\Column(name="anho", type="string", length=4)
     */
    private $anho;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string $descripcion
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @var string $snip
     *
     * @ORM\Column(name="snip", type="string", length=10)
     */
    private $snip;

    /**
     * @var string $siaf
     *
     * @ORM\Column(name="siaf", type="string", length=10)
     */
    private $siaf;

    /**
     * @var integer $estado
     *
     * @ORM\Column(name="estado", type="integer")
     */
    private $estado;

    /**
     * @var string $distrito
     *
     * @ORM\Column(name="distrito", type="string", length=255)
     */
    private $distrito;

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
     * @ORM\Column(name="ejecucion_acumulada", type="integer")
     */
    private $ejecucion_acumulada;

    /**
     * @var integer $avance
     *
     * @ORM\Column(name="avance", type="integer")
     */
    private $avance;

    /**
     * @var string $latitud
     *
     * @ORM\Column(name="latitud", type="string", length=255)
     */
    private $latitud;

    /**
     * @var string $longitud
     *
     * @ORM\Column(name="longitud", type="string", length=255)
     */
    private $longitud;


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
     * Set nombre
     *
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set snip
     *
     * @param string $snip
     */
    public function setSnip($snip)
    {
        $this->snip = $snip;
    }

    /**
     * Get snip
     *
     * @return string 
     */
    public function getSnip()
    {
        return $this->snip;
    }

    /**
     * Set siaf
     *
     * @param string $siaf
     */
    public function setSiaf($siaf)
    {
        $this->siaf = $siaf;
    }

    /**
     * Get siaf
     *
     * @return string 
     */
    public function getSiaf()
    {
        return $this->siaf;
    }

    /**
     * Set estado
     *
     * @param integer $estado
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
     * @param string $distrito
     */
    public function setDistrito($distrito)
    {
        $this->distrito = $distrito;
    }

    /**
     * Get distrito
     *
     * @return string 
     */
    public function getDistrito()
    {
        return $this->distrito;
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
     * @param integer $avance
     */
    public function setAvance($avance)
    {
        $this->avance = $avance;
    }

    /**
     * Get avance
     *
     * @return integer 
     */
    public function getAvance()
    {
        return $this->avance;
    }

    /**
     * Set latitud
     *
     * @param string $latitud
     */
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;
    }

    /**
     * Get latitud
     *
     * @return string 
     */
    public function getLatitud()
    {
        return $this->latitud;
    }

    /**
     * Set longitud
     *
     * @param string $longitud
     */
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;
    }

    /**
     * Get longitud
     *
     * @return string 
     */
    public function getLongitud()
    {
        return $this->longitud;
    }
}