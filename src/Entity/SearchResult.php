<?php

namespace App\Entity;

use App\Repository\SearchResultRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SearchResultRepository::class)]
class SearchResult
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\Regex(
        pattern: '/[^a-zA-Z]/',
        match: false,
        message: 'Genus name can contain only Latin letters',
    )]
    #[Assert\Length(
        min: 2,
        minMessage: 'Genus name has to be at least 2 characters long'
    )]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $genus = null;

    #[Assert\Regex(
        pattern: '/[^a-zA-Z]/',
        match: false,
        message: 'Species name can contain only Latin letters',
    )]
    #[Assert\Length(
        min: 2,
        minMessage: 'Species name has to be at least 2 characters long'
    )]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $species = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenus(): ?string
    {
        return $this->genus;
    }

    public function setGenus(?string $genus): static
    {
        $this->genus = trim($genus);

        return $this;
    }

    public function getSpecies(): ?string
    {
        return $this->species;
    }

    public function setSpecies(?string $species): static
    {
        $this->species = strtolower(trim($species));

        return $this;
    }
}
