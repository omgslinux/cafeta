<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Producto
 *
 * @ORM\Table(name="producto")
 * @ORM\Entity
 */
class Producto
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
     * @var string
     *
     * @ORM\Column(type="string", length=24)
     */
    private $corto;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $largo;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="PedidosProductos", mappedBy="producto")
     */
    private $pedidos;

    public function __construct()
    {
        $this->pedidos=new ArrayCollection();
    }


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
     * Set corto
     *
     * @param string $valor
     *
     * @return Producto
     */
    public function setCorto($valor)
    {
        $this->corto = $valor;

        return $this;
    }

    /**
     * Get corto
     *
     * @return string
     */
    public function getCorto()
    {
        return $this->corto;
    }

    /**
     * Set largo
     *
     * @param string $valor
     *
     * @return Producto
     */
    public function setLargo($valor)
    {
        $this->largo = $valor;

        return $this;
    }

    /**
     * Get largo
     *
     * @return string
     */
    public function getLargo()
    {
        return $this->largo;
    }

    public function __toString()
    {
        return $this->corto;
    }

}
