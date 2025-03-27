<?php

namespace App\Entity;

use App\Repository\SiteRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\InheritanceType;

#[ORM\Entity(repositoryClass: SiteRepository::class)]
#[InheritanceType('SINGLE_TABLE')]
#[DiscriminatorColumn('discriminator')]
#[ORM\DiscriminatorMap([
    'deep-sea-site' => DeepSeaSite::class,
    'dredged-site' => DredgedSite::class,
    'onshore-site' => OnshoreSite::class,
    'unknown-site' => UnknownSite::class
])]
class Site
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?SiteType $siteType = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function printName()
    {
        return $this;
    }

    public function printLocality()
    {
        return $this;
    }

    public function printSiteInfo()
    {
        return $this;
    }
}
