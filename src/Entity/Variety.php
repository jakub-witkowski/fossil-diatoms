<?php

namespace App\Entity;

use App\Repository\VarietyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VarietyRepository::class)]
class Variety
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $authority = null;

    #[ORM\Column]
    private ?int $dateProposed = null;

    /**
     * @var Collection<int, Taxon>
     */
    #[ORM\OneToMany(targetEntity: Taxon::class, mappedBy: 'variety')]
    private Collection $taxon;

    public function __construct()
    {
        $this->taxon = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAuthority(): ?string
    {
        return $this->authority;
    }

    public function setAuthority(string $authority): static
    {
        $this->authority = $authority;

        return $this;
    }

    public function getDateProposed(): ?int
    {
        return $this->dateProposed;
    }

    public function setDateProposed(int $dateProposed): static
    {
        $this->dateProposed = $dateProposed;

        return $this;
    }

    /**
     * @return Collection<int, Taxon>
     */
    public function getTaxon(): Collection
    {
        return $this->taxon;
    }

    public function addTaxon(Taxon $taxon): static
    {
        if (!$this->taxon->contains($taxon)) {
            $this->taxon->add($taxon);
            $taxon->setVariety($this);
        }

        return $this;
    }

    public function removeTaxon(Taxon $taxon): static
    {
        if ($this->taxon->removeElement($taxon)) {
            // set the owning side to null (unless already changed)
            if ($taxon->getVariety() === $this) {
                $taxon->setVariety(null);
            }
        }

        return $this;
    }
}