<?php

namespace App\Entity;

use App\Repository\ProductionsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductionsRepository::class)]
class Productions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $serial = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $production_date = null;

    #[ORM\ManyToOne(targetEntity: Produits::class, inversedBy: 'productions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produits $produit = null;



    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSerial(): ?string
    {
        return $this->serial;
    }

    public function setSerial(?string $serial): self
    {
        $this->serial = $serial;

        return $this;
    }

    public function getProductionDate(): ?\DateTimeInterface
    {
        return $this->production_date;
    }

    public function setProductionDate(\DateTimeInterface $production_date): self
    {
        $this->production_date = $production_date;

        return $this;
    }

    public function getProduit(): ?Produits
    {
        return $this->produit;
    }

    public function setProduit(?Produits $produit): self
    {
        $this->produit = $produit;

        return $this;
    }
}
