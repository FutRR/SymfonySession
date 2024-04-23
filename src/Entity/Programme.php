<?php

namespace App\Entity;

use App\Repository\ProgrammeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgrammeRepository::class)]
class Programme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nbJours = null;

    #[ORM\ManyToOne(inversedBy: 'Programmes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Session $Session = null;

    #[ORM\ManyToOne(inversedBy: 'Programmes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Unite $Unite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbJours(): ?int
    {
        return $this->nbJours;
    }

    public function setNbJours(int $nbJours): static
    {
        $this->nbJours = $nbJours;

        return $this;
    }

    public function getSession(): ?Session
    {
        return $this->Session;
    }

    public function setSession(?Session $Session): static
    {
        $this->Session = $Session;

        return $this;
    }

    public function getUnite(): ?Unite
    {
        return $this->Unite;
    }

    public function setUnite(?Unite $Unite): static
    {
        $this->Unite = $Unite;

        return $this;
    }
}
