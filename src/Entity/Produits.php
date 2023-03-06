<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitsRepository::class)]
class Produits
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $reference = null;

    #[ORM\Column(length: 255)]
    private ?string $designation = null;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: Productions::class)]
    private Collection $productions;

    public function __construct()
    {
        $this->productions = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * @return Collection<int, Productions>
     */
    public function getProductions(): Collection
    {
        return $this->productions;
    }

    public function addProduction(Productions $production): self
    {
        if (!$this->productions->contains($production)) {
            $this->productions->add($production);
            $production->setProduit($this);
        }

        return $this;
    }

    public function removeProduction(Productions $production): self
    {
        if ($this->productions->removeElement($production)) {
            // set the owning side to null (unless already changed)
            if ($production->getProduit() === $this) {
                $production->setProduit(null);
            }
        }

        return $this;
    }
}
