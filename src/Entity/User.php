<?php
// src/Entity/User.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Proveedor", mappedBy="Usuario")
     */
    private $proveedors;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Producto", mappedBy="usuario")
     */
    private $productos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Factura", mappedBy="usuario")
     */
    private $facturas;

    public function __construct()
    {
        parent::__construct();
        $this->proveedors = new ArrayCollection();
        $this->productos = new ArrayCollection();
        $this->facturas = new ArrayCollection();
        // your own logic
    }

    /**
     * @return Collection|Proveedor[]
     */
    public function getProveedors(): Collection
    {
        return $this->proveedors;
    }

    public function addProveedor(Proveedor $proveedor): self
    {
        if (!$this->proveedors->contains($proveedor)) {
            $this->proveedors[] = $proveedor;
            $proveedor->setUsuario($this);
        }

        return $this;
    }

    public function removeProveedor(Proveedor $proveedor): self
    {
        if ($this->proveedors->contains($proveedor)) {
            $this->proveedors->removeElement($proveedor);
            // set the owning side to null (unless already changed)
            if ($proveedor->getUsuario() === $this) {
                $proveedor->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Producto[]
     */
    public function getProductos(): Collection
    {
        return $this->productos;
    }

    public function addProducto(Producto $producto): self
    {
        if (!$this->productos->contains($producto)) {
            $this->productos[] = $producto;
            $producto->setUsuario($this);
        }

        return $this;
    }

    public function removeProducto(Producto $producto): self
    {
        if ($this->productos->contains($producto)) {
            $this->productos->removeElement($producto);
            // set the owning side to null (unless already changed)
            if ($producto->getUsuario() === $this) {
                $producto->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Factura[]
     */
    public function getFacturas(): Collection
    {
        return $this->facturas;
    }

    public function addFactura(Factura $factura): self
    {
        if (!$this->facturas->contains($factura)) {
            $this->facturas[] = $factura;
            $factura->setUsuario($this);
        }

        return $this;
    }

    public function removeFactura(Factura $factura): self
    {
        if ($this->facturas->contains($factura)) {
            $this->facturas->removeElement($factura);
            // set the owning side to null (unless already changed)
            if ($factura->getUsuario() === $this) {
                $factura->setUsuario(null);
            }
        }

        return $this;
    }
}