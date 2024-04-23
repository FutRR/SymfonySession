<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $titreFormation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreFormation(): ?string
    {
        return $this->titreFormation;
    }

    public function setTitreFormation(string $titreFormation): static
    {
        $this->titreFormation = $titreFormation;

        return $this;
    }
}
