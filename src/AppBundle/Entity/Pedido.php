<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Producto;
use AppBundle\Entity\PedidosProductos;

/**
 * Pedido
 *
 * @ORM\Table(name="pedido")
 * @ORM\Entity
 */
class Pedido
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
     * @ORM\Column(type="datetime")
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(type="float", precision=10, scale=2)
     */
    private $total;

    /**
     * @var string
     *
     * @ORM\Column(name="comentario", type="text", nullable=true)
     */
    private $comentario;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="PedidosProductos", mappedBy="pedido", cascade={"persist","remove"}, orphanRemoval=true)
     */
    private $productos;


    public function __construct()
    {
        $this->productos=new ArrayCollection();
        $this->fecha=new \DateTime();
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
     * Set fecha
     *
     * @param date $fecha
     *
     * @return Pedido
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
     * Set total
     *
     * @param float $total
     *
     * @return Pedido
     */
    public function setTotal($valor)
    {
        $this->total = $valor;

        return $this;
    }

    /**
     * Get total
     *
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set comentario
     *
     * @param text $comentario
     *
     * @return Pedido
     */
    public function setComentario($valor)
    {
        $this->comentario = $valor;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Add producto
     *
     * @param Producto $producto
     *
     * @return Pedido
     */
    public function addProducto(PedidosProductos $producto)
    {
        $producto->setPedido($this);
        $this->productos->add($producto);

        return $this;
    }

    /**
     * Get productos
     *
     * @return Producto
     */
    public function getProductos()
    {
        return $this->productos;
    }

    /**
     * Remove producto
     *
     * @param Producto $producto
     *
     * @return Pedido
     */
    public function removeProducto(PedidosProductos $producto)
    {
        $this->productos->removeElement($producto);

        return $this;
    }


    public function __toString()
    {
        return $this->fecha->format('d/m/Y');
    }

}
