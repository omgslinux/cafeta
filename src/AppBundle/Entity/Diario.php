<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Colectivos;
use AppBundle\Entity\Calendario;

/**
 * Diario
 *
 * @ORM\Table(name="diario")
 * @ORM\Entity
 */
class Diario
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
     * @var Calendario
     *
     * @ORM\Column(type="date")
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=true)
     */
    private $inicial;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=true)
     */
    private $final;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=true)
     */
    private $sobre;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable", type="string", length=45, nullable=true)
     */
    private $responsable;

    /**
     * @var text
     *
     * @ORM\Column(type="text",length=100)
     */
    private $colectivo;

    /**
     * @var text
     *
     * @ORM\Column(type="text")
     */
    private $observaciones;



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
     * @return Diario
     */
    public function setFecha($valor)
    {
        $this->fecha = $valor;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set inicial
     *
     * @param decimal $inicial
     *
     * @return Diario
     */
    public function setInicial($valor)
    {
        $this->inicial = $valor;

        return $this;
    }

    /**
     * Get inicial
     *
     * @return decimal
     */
    public function getInicial()
    {
        return $this->inicial;
    }

    /**
     * Set final
     *
     * @param decimal $final
     *
     * @return Diario
     */
    public function setFinal($valor)
    {
        $this->final = $valor;

        return $this;
    }

    /**
     * Get final
     *
     * @return decimal
     */
    public function getFinal()
    {
        return $this->final;
    }

    /**
     * Set sobre
     *
     * @param decimal $sobre
     *
     * @return Diario
     */
    public function setSobre($valor)
    {
        $this->sobre = $valor;

        return $this;
    }

    /**
     * Get sobre
     *
     * @return decimal
     */
    public function getSobre()
    {
        return $this->sobre;
    }



    /**
     * Set responsable
     *
     * @param string $responsable
     *
     * @return Diario
     */
    public function setResponsable($valor)
    {
        $this->responsable = $valor;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return string
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set colectivo
     *
     * @param string $colectivo
     *
     * @return Diario
     */
    public function setColectivo($valor)
    {
        $this->colectivo = $valor;

        return $this;
    }

    /**
     * Get colectivo
     *
     * @return string
     */
    public function getColectivo()
    {
        return $this->colectivo;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return Diario
     */
    public function setObservaciones($valor)
    {
        $this->observaciones = $valor;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }



}
