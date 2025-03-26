<?php

namespace App\Entity;

use App\Repository\GenusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
// use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: GenusRepository::class)]
class Genus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    // #[Assert\NotBlank('Genus name is mandatory')]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $authority = null;

    #[ORM\Column]
    private ?int $dateProposed = null;

    /**
     * @var Collection<int, Taxon>
     */
    #[ORM\OneToMany(targetEntity: Taxon::class, mappedBy: 'genus')]
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
            $taxon->setGenus($this);
        }

        return $this;
    }

    public function removeTaxon(Taxon $taxon): static
    {
        if ($this->taxon->removeElement($taxon)) {
            // set the owning side to null (unless already changed)
            if ($taxon->getGenus() === $this) {
                $taxon->setGenus(null);
            }
        }

        return $this;
    }

    public function __toString():string
    {
        return $this->getName();
    }
}
