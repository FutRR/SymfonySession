<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nomCategorie = null;

    /**
     * @var Collection<int, Unite>
     */
    #[ORM\OneToMany(targetEntity: Unite::class, mappedBy: 'Categorie')]
    private Collection $Unites;

    public function __construct()
    {
        $this->Unites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCategorie(): ?string
    {
        return $this->nomCategorie;
    }

    public function setNomCategorie(string $nomCategorie): static
    {
        $this->nomCategorie = $nomCategorie;

        return $this;
    }

    /**
     * @return Collection<int, Unite>
     */
    public function getUnites(): Collection
    {
        return $this->Unites;
    }

    public function addUnite(Unite $unite): static
    {
        if (!$this->Unites->contains($unite)) {
            $this->Unites->add($unite);
            $unite->setCategorie($this);
        }

        return $this;
    }

    public function removeUnite(Unite $unite): static
    {
        if ($this->Unites->removeElement($unite)) {
            // set the owning side to null (unless already changed)
            if ($unite->getCategorie() === $this) {
                $unite->setCategorie(null);
            }
        }

        return $this;
    }
}
