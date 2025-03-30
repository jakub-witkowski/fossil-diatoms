<?php

namespace App\Entity;

use App\Repository\SlideRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\InheritanceType;

#[ORM\Entity(repositoryClass: SlideRepository::class)]
#[InheritanceType('SINGLE_TABLE')]
#[DiscriminatorColumn('discriminator')]
#[ORM\DiscriminatorMap([
    'bm-slide' => BMslide::class,
    'uni-szczecin-slide' => UniSzczecinSlide::class,
    'unnamed-slide' => UnnamedSlide::class,
])]
class Slide
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'slides')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sample $sample = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function printSlideInfo(): string
    {
        return $this;
    }

    public function __toString(): string
    {
        return $this->label;
    }
}
