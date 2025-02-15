<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhotoRepository::class)]
class Photo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'photo')]
    private ?Taxon $taxon = null;

    #[ORM\ManyToOne(inversedBy: 'photo')]
    private ?Sample $sample = null;

    #[ORM\ManyToOne(inversedBy: 'photo')]
    private ?Microscope $microscope = null;

    #[ORM\ManyToOne(inversedBy: 'photo')]
    private ?Technique $technique = null;

    #[ORM\Column]
    private ?bool $isPublished = null;

    #[ORM\Column(length: 255)]
    private ?string $filename = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $timesViewed = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateAdded = null;

    #[ORM\Column(nullable: true)]
    private ?int $specimenNumericalAge = null;

    #[ORM\ManyToOne]
    private ?RelativeAge $relativeAge = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTaxon(): ?Taxon
    {
        return $this->taxon;
    }

    public function setTaxon(?Taxon $taxon): static
    {
        $this->taxon = $taxon;

        return $this;
    }

    public function getSample(): ?Sample
    {
        return $this->sample;
    }

    public function setSample(?Sample $sample): static
    {
        $this->sample = $sample;

        return $this;
    }

    public function getMicroscope(): ?Microscope
    {
        return $this->microscope;
    }

    public function setMicroscope(?Microscope $microscope): static
    {
        $this->microscope = $microscope;

        return $this;
    }

    public function getTechnique(): ?Technique
    {
        return $this->technique;
    }

    public function setTechnique(?Technique $technique): static
    {
        $this->technique = $technique;

        return $this;
    }

    public function isPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setPublished(bool $isPublished): static
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): static
    {
        $this->filename = $filename;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getTimesViewed(): ?int
    {
        return $this->timesViewed;
    }

    public function setTimesViewed(int $timesViewed): static
    {
        $this->timesViewed = $timesViewed;

        return $this;
    }

    public function getDateAdded(): ?\DateTimeInterface
    {
        return $this->dateAdded;
    }

    public function setDateAdded(\DateTimeInterface $dateAdded): static
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    public function getSpecimenNumericalAge(): ?int
    {
        return $this->specimenNumericalAge;
    }

    public function setSpecimenNumericalAge(?int $specimenNumericalAge): static
    {
        $this->specimenNumericalAge = $specimenNumericalAge;

        return $this;
    }

    public function getRelativeAge(): ?RelativeAge
    {
        return $this->relativeAge;
    }

    public function setRelativeAge(?RelativeAge $relativeAge): static
    {
        $this->relativeAge = $relativeAge;

        return $this;
    }

    public function incrementTimesViewed(): self
    {
        // $this->setTimesViewed($this->getTimesViewed() + 1);
        $this->timesViewed = $this->timesViewed + 1;

        return $this;
    }
}
