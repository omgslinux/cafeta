<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Pedido;
use AppBundle\Entity\Producto;

/**
 * PedidosProductos
 *
 * @ORM\Table
 * @ORM\Entity
 */
class PedidosProductos
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Pedido", inversedBy="productos")
     */
    private $pedido;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Producto", inversedBy="pedidos")
     */
    private $producto;

    /**
     * @var string
     *
     * @ORM\Column(type="float", precision=10, scale=2)
     */
    private $importe;


    /**
     * Set pedido
     *
     * @param Pedido $valor
     *
     * @return PedidosProductos
     */
    public function setPedido(Pedido $valor)
    {
        $this->pedido = $valor;

        return $this;
    }

    /**
    * Get pedido
    *
    * @return Producto
    */
    public function getPedido()
    {
      return $this->pedido;
    }

    /**
     * Get producto
     *
     * @return Producto
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Set producto
     *
     * @param Producto $producto
     *
     * @return PedidosProductos
     */
    public function setProducto(Producto $valor)
    {
        $this->producto = $valor;

        return $this;
    }

    /**
     * Set importe
     *
     * @param float $importe
     *
     * @return PedidosProductos
     */
    public function setImporte($valor)
    {
        $this->importe = $valor;

        return $this;
    }

    /**
     * Get importe
     *
     * @return float
     */
    public function getImporte()
    {
        return $this->importe;
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

}
