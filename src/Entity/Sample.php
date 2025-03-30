<?php

namespace App\Entity;

use App\Repository\SampleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SampleRepository::class)]
class Sample
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $label = null;

    #[ORM\ManyToOne(inversedBy: 'samples')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Site $site = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getSite(): ?Site
    {
        return $this->site;
    }

    public function setSite(?Site $site): static
    {
        $this->site = $site;

        return $this;
    }

    public function printInfo(): ?string
    {
        $label = ($this->label !== null) ? $this->label . ', ' : null;

        $info =
            $label .  ', ' .
            $this->getSite()->printSiteInfo();
        ;
        return $info;
    }
}
