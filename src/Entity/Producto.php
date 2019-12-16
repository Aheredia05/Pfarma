<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductoRepository")
 */
class Producto
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $precio;

    /**
     * @ORM\Column(type="integer")
     */
    private $cantidad;

    /**
     * @ORM\Column(type="text")
     */
    private $foto;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Entradas", mappedBy="producto")
     */
    private $entradas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Detalleproduct", mappedBy="producto")
     */
    private $detalleproducts;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Proveedor", inversedBy="productos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $proveedor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="productos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Detallefactura", mappedBy="producto")
     */
    private $detallefacturas;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    public function __construct()
    {
        $this->entradas = new ArrayCollection();
        $this->detalleproducts = new ArrayCollection();
        $this->detallefacturas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * @return Collection|Entradas[]
     */
    public function getEntradas(): Collection
    {
        return $this->entradas;
    }

    public function addEntrada(Entradas $entrada): self
    {
        if (!$this->entradas->contains($entrada)) {
            $this->entradas[] = $entrada;
            $entrada->setProducto($this);
        }

        return $this;
    }

    public function removeEntrada(Entradas $entrada): self
    {
        if ($this->entradas->contains($entrada)) {
            $this->entradas->removeElement($entrada);
            // set the owning side to null (unless already changed)
            if ($entrada->getProducto() === $this) {
                $entrada->setProducto(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Detalleproduct[]
     */
    public function getDetalleproducts(): Collection
    {
        return $this->detalleproducts;
    }

    public function addDetalleproduct(Detalleproduct $detalleproduct): self
    {
        if (!$this->detalleproducts->contains($detalleproduct)) {
            $this->detalleproducts[] = $detalleproduct;
            $detalleproduct->setProducto($this);
        }

        return $this;
    }

    public function removeDetalleproduct(Detalleproduct $detalleproduct): self
    {
        if ($this->detalleproducts->contains($detalleproduct)) {
            $this->detalleproducts->removeElement($detalleproduct);
            // set the owning side to null (unless already changed)
            if ($detalleproduct->getProducto() === $this) {
                $detalleproduct->setProducto(null);
            }
        }

        return $this;
    }

    public function getProveedor(): ?Proveedor
    {
        return $this->proveedor;
    }

    public function setProveedor(?Proveedor $proveedor): self
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    public function getUsuario(): ?User
    {
        return $this->usuario;
    }

    public function setUsuario(?User $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * @return Collection|Detallefactura[]
     */
    public function getDetallefacturas(): Collection
    {
        return $this->detallefacturas;
    }

    public function addDetallefactura(Detallefactura $detallefactura): self
    {
        if (!$this->detallefacturas->contains($detallefactura)) {
            $this->detallefacturas[] = $detallefactura;
            $detallefactura->setProducto($this);
        }

        return $this;
    }

    public function removeDetallefactura(Detallefactura $detallefactura): self
    {
        if ($this->detallefacturas->contains($detallefactura)) {
            $this->detallefacturas->removeElement($detallefactura);
            // set the owning side to null (unless already changed)
            if ($detallefactura->getProducto() === $this) {
                $detallefactura->setProducto(null);
            }
        }

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }
}
