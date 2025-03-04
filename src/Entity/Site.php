<?php

namespace App\Entity;

use App\Repository\SiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SiteRepository::class)]
class Site
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nameOrNumberPrimary = null;

    #[ORM\Column(length: 255)]
    private ?string $nameOrNumberSecondary = null;

    /**
     * @var Collection<int, Sample>
     */
    #[ORM\OneToMany(targetEntity: Sample::class, mappedBy: 'site')]
    private Collection $sample;

    #[ORM\ManyToOne(inversedBy: 'site')]
    private ?SiteType $siteType = null;

    #[ORM\ManyToOne(inversedBy: 'site')]
    private ?Campaign $campaign = null;

    #[ORM\ManyToOne(inversedBy: 'site')]
    private ?Geography $geography = null;

    public function __construct()
    {
        $this->sample = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameOrNumberPrimary(): ?string
    {
        return $this->nameOrNumberPrimary;
    }

    public function setNameOrNumberPrimary(string $nameOrNumberPrimary): static
    {
        $this->nameOrNumberPrimary = $nameOrNumberPrimary;

        return $this;
    }

    public function getNameOrNumberSecondary(): ?string
    {
        return $this->nameOrNumberSecondary;
    }

    public function setNameOrNumberSecondary(string $nameOrNumberSecondary): static
    {
        $this->nameOrNumberSecondary = $nameOrNumberSecondary;

        return $this;
    }

    public function getNameOrNumber(): string
    {
        return $this->nameOrNumberPrimary . $this->nameOrNumberSecondary;
    }

    /**
     * @return Collection<int, Sample>
     */
    public function getSample(): Collection
    {
        return $this->sample;
    }

    public function addSample(Sample $sample): static
    {
        if (!$this->sample->contains($sample)) {
            $this->sample->add($sample);
            $sample->setSite($this);
        }

        return $this;
    }

    public function removeSample(Sample $sample): static
    {
        if ($this->sample->removeElement($sample)) {
            // set the owning side to null (unless already changed)
            if ($sample->getSite() === $this) {
                $sample->setSite(null);
            }
        }

        return $this;
    }

    public function getSiteType(): ?SiteType
    {
        return $this->siteType;
    }

    public function setSiteType(?SiteType $siteType): static
    {
        $this->siteType = $siteType;

        return $this;
    }

    public function getCampaign(): ?Campaign
    {
        return $this->campaign;
    }

    public function setCampaign(?Campaign $campaign): static
    {
        $this->campaign = $campaign;

        return $this;
    }

    public function getGeography(): ?Geography
    {
        return $this->geography;
    }

    public function setGeography(?Geography $geography): static
    {
        $this->geography = $geography;

        return $this;
    }

    public function __toString(): string
    {
        return $this->nameOrNumberPrimary . " ". $this->nameOrNumberSecondary;
    }
}
