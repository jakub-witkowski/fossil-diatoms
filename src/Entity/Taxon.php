<?php

namespace App\Entity;

use App\Repository\TaxonRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaxonRepository::class)]
class Taxon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'taxon')]
    private ?Genus $genus = null;

    #[ORM\ManyToOne(inversedBy: 'taxon')]
    private ?Species $species = null;

    #[ORM\ManyToOne(inversedBy: 'taxon')]
    private ?Variety $variety = null;

    #[ORM\ManyToOne(inversedBy: 'taxon')]
    private ?TaxonType $taxonType = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $diatomBase = null;

    #[ORM\Column(nullable: true)]
    private ?float $numericalAgeBase = null;

    #[ORM\Column(nullable: true)]
    private ?float $numericalAgeTop = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $relativeAgeBase = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $relativeAgeTop = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenus(): ?Genus
    {
        return $this->genus;
    }

    public function setGenus(?Genus $genus): static
    {
        $this->genus = $genus;

        return $this;
    }

    public function getSpecies(): ?Species
    {
        return $this->species;
    }

    public function setSpecies(?Species $species): static
    {
        $this->species = $species;

        return $this;
    }

    public function getVariety(): ?Variety
    {
        return $this->variety;
    }

    public function setVariety(?Variety $variety): static
    {
        $this->variety = $variety;

        return $this;
    }

    public function getTaxonType(): ?TaxonType
    {
        return $this->taxonType;
    }

    public function setTaxonType(?TaxonType $taxonType): static
    {
        $this->taxonType = $taxonType;

        return $this;
    }

    public function getDiatomBase(): ?string
    {
        return $this->diatomBase;
    }

    public function setDiatomBase(string $diatomBase): static
    {
        $this->diatomBase = $diatomBase;

        return $this;
    }

    public function getNumericalAgeBase(): ?float
    {
        return $this->numericalAgeBase;
    }

    public function setNumericalAgeBase(float $numericalAgeBase): static
    {
        $this->numericalAgeBase = $numericalAgeBase;

        return $this;
    }

    public function getNumericalAgeTop(): ?float
    {
        return $this->numericalAgeTop;
    }

    public function setNumericalAgeTop(float $numericalAgeTop): static
    {
        $this->numericalAgeTop = $numericalAgeTop;

        return $this;
    }

    public function getRelativeAgeBase(): ?string
    {
        return $this->relativeAgeBase;
    }

    public function setRelativeAgeBase(?string $relativeAgeBase): static
    {
        $this->relativeAgeBase = $relativeAgeBase;

        return $this;
    }

    public function getRelativeAgeTop(): ?string
    {
        return $this->relativeAgeTop;
    }

    public function setRelativeAgeTop(?string $relativeAgeTop): static
    {
        $this->relativeAgeTop = $relativeAgeTop;

        return $this;
    }
}
