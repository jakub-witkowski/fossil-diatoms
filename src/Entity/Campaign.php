<?php

namespace App\Entity;

use App\Repository\CampaignRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CampaignRepository::class)]
class Campaign
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $abbreviation = null;

    #[ORM\Column(length: 255)]
    private ?string $fullName = null;

    /**
     * @var Collection<int, Site>
     */
    #[ORM\OneToMany(targetEntity: Site::class, mappedBy: 'campaign')]
    private Collection $site;

    public function __construct()
    {
        $this->site = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAbbreviation(): ?string
    {
        return $this->abbreviation;
    }

    public function setAbbreviation(string $abbreviation): static
    {
        $this->abbreviation = $abbreviation;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): static
    {
        $this->fullName = $fullName;

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
            $site->setCampaign($this);
        }

        return $this;
    }

    public function removeSite(Site $site): static
    {
        if ($this->site->removeElement($site)) {
            // set the owning side to null (unless already changed)
            if ($site->getCampaign() === $this) {
                $site->setCampaign(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->abbreviation;
    }
}
