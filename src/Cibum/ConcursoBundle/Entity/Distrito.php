<?php

namespace Cibum\ConcursoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Cibum\ConcursoBundle\Entity\Distrito
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Cibum\ConcursoBundle\Entity\DistritoRepository")
 */
class Distrito
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
     * @var string $longitud
     *
     * @ORM\Column(name="longitud", type="string", length=255, nullable=true)
     */
    private $longitud;

    /**
     * @var string $latitud
     *
     * @ORM\Column(name="latitud", type="string", length=255, nullable=true)
     */
    private $latitud;

    /**
     * @var string $anuales
     *
     * @ORM\ManyToMany(targetEntity="Anual", inversedBy="distritos")
     */
    private $anuales;

    function __construct()
    {
        $this->anuales = new ArrayCollection();
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
     * Set anuales
     *
     * @param string $anuales
     */
    public function setAnuales($anuales)
    {
        $this->anuales = $anuales;
    }

    /**
     * Add an anual project budget
     *
     * @param Anual $anual
     */
    public function addAnual(Anual $anual)
    {
        $this->anuales[] = $anual;
    }

    /**
     * Get anuales
     *
     * @return string 
     */
    public function getAnuales()
    {
        return $this->anuales;
    }
}