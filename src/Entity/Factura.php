<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FacturaRepository")
 */
class Factura
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Fecha;

    /**
     * @ORM\Column(type="float")
     */
    private $totalfactura;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Detallefactura", mappedBy="factura")
     */
    private $detallefacturas;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="facturas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cliente", inversedBy="facturas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cliente;

    public function __construct()
    {
        $this->detallefacturas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->Fecha;
    }

    public function setFecha(\DateTimeInterface $Fecha): self
    {
        $this->Fecha = $Fecha;

        return $this;
    }

    public function getTotalfactura(): ?float
    {
        return $this->totalfactura;
    }

    public function setTotalfactura(float $totalfactura): self
    {
        $this->totalfactura = $totalfactura;

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
            $detallefactura->setFactura($this);
        }

        return $this;
    }

    public function removeDetallefactura(Detallefactura $detallefactura): self
    {
        if ($this->detallefacturas->contains($detallefactura)) {
            $this->detallefacturas->removeElement($detallefactura);
            // set the owning side to null (unless already changed)
            if ($detallefactura->getFactura() === $this) {
                $detallefactura->setFactura(null);
            }
        }

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

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }
}
