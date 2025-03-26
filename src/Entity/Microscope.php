<?php

namespace App\Entity;

use App\Repository\MicroscopeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MicroscopeRepository::class)]
class Microscope
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'microscope')]
    private ?Producer $producer = null;

    #[ORM\ManyToOne(inversedBy: 'microscope')]
    private ?Model $model = null;

    #[ORM\ManyToOne(inversedBy: 'microscope')]
    private ?Objective $objective = null;

    #[ORM\ManyToOne(inversedBy: 'microscope')]
    private ?Camera $camera = null;

    /**
     * @var Collection<int, Photo>
     */
    #[ORM\OneToMany(targetEntity: Photo::class, mappedBy: 'microscope')]
    private Collection $photo;

    public function __construct()
    {
        $this->photo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->producer . " " . $this->model . " " . $this->objective . " " . $this->camera;
    }

    public function getProducer(): ?Producer
    {
        return $this->producer;
    }

    public function setProducer(?Producer $producer): static
    {
        $this->producer = $producer;

        return $this;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(?Model $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getObjective(): ?Objective
    {
        return $this->objective;
    }

    public function setObjective(?Objective $objective): static
    {
        $this->objective = $objective;

        return $this;
    }

    public function getCamera(): ?Camera
    {
        return $this->camera;
    }

    public function setCamera(?Camera $camera): static
    {
        $this->camera = $camera;

        return $this;
    }

    /**
     * @return Collection<int, Photo>
     */
    public function getPhoto(): Collection
    {
        return $this->photo;
    }

    public function addPhoto(Photo $photo): static
    {
        if (!$this->photo->contains($photo)) {
            $this->photo->add($photo);
            $photo->setMicroscope($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): static
    {
        if ($this->photo->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getMicroscope() === $this) {
                $photo->setMicroscope(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->producer . " " . $this->model . " " . $this->objective . " " . $this->camera;
    }
}
