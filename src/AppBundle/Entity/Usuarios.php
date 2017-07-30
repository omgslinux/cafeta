<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Usuarios
 *
 * @ORM\Table(name="usuarios")
 * @ORM\Entity
 */
class Usuarios implements UserInterface
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
     * @ORM\Column(name="nombre", type="string", length=45, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=100, nullable=true)
     */
    private $password;

    /**
     * @var boolean
     *
     * @ORM\Column(name="admin", type="boolean", nullable=true)
     */

    private $admin;
    /**
     * @var string
     *
     */
    private $plainPassword;


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
     * Set user
     *
     * @param string $nombre
     *
     * @return usuarios
     */
    public function setNombre($valor)
    {
        $this->nombre = $valor;

        return $this;
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
     * Set password
     *
     * @param string $password
     *
     * @return usuarios
     */
    public function setPassword($valor)
    {
        $this->password = $valor;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set plainPassword
     *
     * @param string $plainPassword
     *
     * @return usuarios
     */
    public function setPlainPassword($valor)
    {
        $this->plainPassword = $valor;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * Set admin
     *
     * @param boolean $admin
     *
     * @return usuarios
     */
    public function setAdmin($valor)
    {
        $this->admin = $valor;

        return $this;
    }

    /**
     * Is admin
     *
     * @return string
     */
    public function isAdmin()
    {
        return $this->admin;
    }

    public function getRoles()
    {
        if ($this->isAdmin()) {
            return ['ROLE_ADMIN'];
        } elseif ($this->getId()) {
            return ['ROLE_USER'];
        } else {
            return [];
        }
    }

    public function getRol()
    {
        $rol=$this->getRoles();
        if (is_array($rol)) {
          return $this->getRoles()[0];
        } else {
          return false;
        }
    }

    public function eraseCredentials()
    {

    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->getNombre();
    }

    public function serialize()
    {
        return serialize(array(
          $this->id,
          $this->user,
          $this->password,
          $this->active
        ));
    }

    public function unserialize($serialized)
    {
        list(
          $this->id,
          $this->user,
          $this->password,
          $this->active,
        ) = userialize($serialized);
    }




    public function __toString()
    {
        return $this->getUser();
    }

}
