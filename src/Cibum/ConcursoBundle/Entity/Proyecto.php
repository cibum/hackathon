<?php

namespace Cibum\ConcursoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @var Anual[] $anual
     *
     * @ORM\OneToMany(targetEntity="Anual", mappedBy="proyecto")
     */
    protected $anuales;

    /**
     * @var Comment[] $comments
     *
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="proyecto")
     */
    protected $comments;

    function __construct()
    {
        $this->anuales = new ArrayCollection();
        $this->comments = new ArrayCollection();
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

    /**
     * @param \Cibum\ConcursoBundle\Entity\Anual[] $anuales
     */
    public function setAnuales($anuales)
    {
        $this->anuales = array();

        foreach($anuales as $anual) {
            $this->addAnual($anual);
        }
    }

    public function addAnual(Anual $anual)
    {
        $this->anuales[] = $anual;
        $anual->setProyecto($this);
    }

    /**
     * @return \Cibum\ConcursoBundle\Entity\Anual
     */
    public function getAnuales()
    {
        return $this->anuales;
    }


}