<?php

namespace App\Entity;

use App\Repository\TaxonRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\InheritanceType;

#[ORM\Entity(repositoryClass: TaxonRepository::class)]
#[InheritanceType('SINGLE_TABLE')]
#[DiscriminatorColumn('discriminator')]
#[ORM\DiscriminatorMap([
    'genus' => Genus::class,
    'species' => Species::class,
    'variety' => Variety::class,
])]
class Taxon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $diatomBase = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function printTaxonInfo(): string
    {
        return $this;
    }

    public function __toString(): string
    {
        return $this->printTaxonInfo();
    }
}
