<?php

namespace App\Entity;

use App\Repository\UniteRepository;
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
}
