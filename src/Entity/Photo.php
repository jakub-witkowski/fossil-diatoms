<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
//use App\Service\UploaderHelper;
use Doctrine\DBAL\Types\Types;
//use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhotoRepository::class)]
class Photo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $isPublished = null;

    #[ORM\Column(length: 255)]
    private ?string $filename = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $timesViewed = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
//    #[Gedmo\Timestampable(on: 'create')]
//    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $dateAdded = null;

    #[ORM\ManyToOne(inversedBy: 'photos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Taxon $taxon = null;

    #[ORM\ManyToOne(inversedBy: 'photos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Slide $slide = null;

    #[ORM\ManyToOne(inversedBy: 'photos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Microscope $microscope = null;

    #[ORM\ManyToOne(inversedBy: 'photos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Technique $technique = null;

    #[ORM\ManyToOne(inversedBy: 'photos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?RelativeAge $relativeAge = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): static
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

//    public function getFilename(): ?string
//    {
//        return UploaderHelper::PHOTO . '/' . $this->filename;
//    }

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

    public function getTaxon(): ?Taxon
    {
        return $this->taxon;
    }

    public function setTaxon(?Taxon $taxon): static
    {
        $this->taxon = $taxon;

        return $this;
    }

    public function getSlide(): ?Slide
    {
        return $this->slide;
    }

    public function setSlide(?Slide $slide): static
    {
        $this->slide = $slide;

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
        $this->timesViewed = $this->timesViewed + 1;

        return $this;
    }
}
