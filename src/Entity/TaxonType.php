<?php

namespace App\Entity;

use App\Repository\TaxonTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaxonTypeRepository::class)]
class TaxonType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    /**
     * @var Collection<int, Taxon>
     */
    #[ORM\OneToMany(targetEntity: Taxon::class, mappedBy: 'taxonType')]
    private Collection $taxon;

    public function __construct()
    {
        $this->taxon = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

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
            $taxon->setTaxonType($this);
        }

        return $this;
    }

    public function removeTaxon(Taxon $taxon): static
    {
        if ($this->taxon->removeElement($taxon)) {
            // set the owning side to null (unless already changed)
            if ($taxon->getTaxonType() === $this) {
                $taxon->setTaxonType(null);
            }
        }

        return $this;
    }
}
