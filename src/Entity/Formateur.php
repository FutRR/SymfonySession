<?php

namespace App\Entity;

use App\Repository\FormateurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormateurRepository::class)]
class Formateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomFormateur = null;

    #[ORM\Column(length: 50)]
    private ?string $prenomFormateur = null;

    #[ORM\Column(length: 50)]
    private ?string $emailFormateur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFormateur(): ?string
    {
        return $this->nomFormateur;
    }

    public function setNomFormateur(string $nomFormateur): static
    {
        $this->nomFormateur = $nomFormateur;

        return $this;
    }

    public function getPrenomFormateur(): ?string
    {
        return $this->prenomFormateur;
    }

    public function setPrenomFormateur(string $prenomFormateur): static
    {
        $this->prenomFormateur = $prenomFormateur;

        return $this;
    }

    public function getEmailFormateur(): ?string
    {
        return $this->emailFormateur;
    }

    public function setEmailFormateur(string $emailFormateur): static
    {
        $this->emailFormateur = $emailFormateur;

        return $this;
    }
}
