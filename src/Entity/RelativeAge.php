<?php

namespace App\Entity;

use App\Repository\RelativeAgeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RelativeAgeRepository::class)]
class RelativeAge
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $midpointDate = null;

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

    public function getMidpointDate(): ?int
    {
        return $this->midpointDate;
    }

    public function setMidpointDate(int $midpointDate): static
    {
        $this->midpointDate = $midpointDate;

        return $this;
    }
}
