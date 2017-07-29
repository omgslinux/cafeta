<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Calendario;
use AppBundle\Entity\Colectivos;

/**
 * Calendario
 *
 * @ORM\Table(name="calendario")
 * @ORM\Entity
 */
class Calendario
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="integer")
     */
    private $turno;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Colectivos", inversedBy="colectivo")
     */
    private $colectivo;



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Calendario
     */
    public function setFecha($valor)
    {
        $this->fecha = $valor;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set turno
     *
     * @param integer $turno
     *
     * @return Calendario
     */
    public function setTurno($valor)
    {
        $this->turno = $valor;

        return $this;
    }

    /**
     * Get turno
     *
     * @return integer
     */
    public function getTurno()
    {
        return $this->turno;
    }

    /**
     * Set colectivo
     *
     * @param Colectivos $colectivo
     *
     * @return Calendario
     */
    public function setColectivo(Colectivos $valor)
    {
        $this->colectivo = $valor;

        return $this;
    }

    /**
     * Get colectivo
     *
     * @return Colectivos
     */
    public function getColectivo()
    {
        return $this->colectivo;
    }


}
