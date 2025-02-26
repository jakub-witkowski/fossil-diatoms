<?php

namespace App\Entity;

use App\Repository\GeographyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GeographyRepository::class)]
class Geography
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $featurePrimary = null;

    #[ORM\Column(length: 255)]
    private ?string $featureSecondary = null;

    /**
     * @var Collection<int, Site>
     */
    #[ORM\OneToMany(targetEntity: Site::class, mappedBy: 'geography')]
    private Collection $site;

    public function __construct()
    {
        $this->site = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFeaturePrimary(): ?string
    {
        return $this->featurePrimary;
    }

    public function setFeaturePrimary(string $featurePrimary): static
    {
        $this->featurePrimary = $featurePrimary;

        return $this;
    }

    public function getFeatureSecondary(): ?string
    {
        return $this->featureSecondary;
    }

    public function setFeatureSecondary(string $featureSecondary): static
    {
        $this->featureSecondary = $featureSecondary;

        return $this;
    }

    /**
     * @return Collection<int, Site>
     */
    public function getSite(): Collection
    {
        return $this->site;
    }

    public function addSite(Site $site): static
    {
        if (!$this->site->contains($site)) {
            $this->site->add($site);
            $site->setGeography($this);
        }

        return $this;
    }

    public function removeSite(Site $site): static
    {
        if ($this->site->removeElement($site)) {
            // set the owning side to null (unless already changed)
            if ($site->getGeography() === $this) {
                $site->setGeography(null);
            }
        }

        return $this;
    }
}
