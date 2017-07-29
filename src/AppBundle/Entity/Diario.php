<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Colectivos;
use AppBundle\Entity\Calendario;

/**
 * Diario
 *
 * @ORM\Table(name="diario", uniqueConstraints={@ORM\UniqueConstraint(name="fecha_UNIQUE", columns={"fecha"})})
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
     * @var \DateTime
     *
     * @ORM\ManyToOne(TargeEntity="Calendario", inversedBy="turnos")
     */
    private $turno;

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
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Colectivos", inversedBy="colectivos")
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
     * Set turno
     *
     * @param Calendario $turno
     *
     * @return Diario
     */
    public function setTurno(Calendario $valor)
    {
        $this->turno = $valor;

        return $this;
    }

    /**
     * Get turno
     *
     * @return string
     */
    public function getTurno()
    {
        return $this->turno;
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
     * @param Colectivos $colectivo
     *
     * @return Diario
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
