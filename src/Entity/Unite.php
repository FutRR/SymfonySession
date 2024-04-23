<?php

namespace App\Entity;

use App\Repository\UniteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UniteRepository::class)]
class Unite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nomUnite = null;

    /**
     * @var Collection<int, Programme>
     */
    #[ORM\OneToMany(targetEntity: Programme::class, mappedBy: 'Unite')]
    private Collection $Programmes;

    public function __construct()
    {
        $this->Programmes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomUnite(): ?string
    {
        return $this->nomUnite;
    }

    public function setNomUnite(string $nomUnite): static
    {
        $this->nomUnite = $nomUnite;

        return $this;
    }

    /**
     * @return Collection<int, Programme>
     */
    public function getProgrammes(): Collection
    {
        return $this->Programmes;
    }

    public function addProgramme(Programme $programme): static
    {
        if (!$this->Programmes->contains($programme)) {
            $this->Programmes->add($programme);
            $programme->setUnite($this);
        }

        return $this;
    }

    public function removeProgramme(Programme $programme): static
    {
        if ($this->Programmes->removeElement($programme)) {
            // set the owning side to null (unless already changed)
            if ($programme->getUnite() === $this) {
                $programme->setUnite(null);
            }
        }

        return $this;
    }
}
