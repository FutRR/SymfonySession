<?php

namespace App\Entity;

use App\Repository\StagiaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StagiaireRepository::class)]
class Stagiaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomStagiaire = null;

    #[ORM\Column(length: 50)]
    private ?string $prenomStagiaire = null;

    #[ORM\Column(length: 50)]
    private ?string $emailStagiaire = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $ville = null;

    /**
     * @var Collection<int, Session>
     */
    #[ORM\ManyToMany(targetEntity: Session::class, inversedBy: 'Stagiaires')]
    private Collection $Sessions;

    public function __construct()
    {
        $this->Sessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomStagiaire(): ?string
    {
        return $this->nomStagiaire;
    }

    public function setNomStagiaire(string $nomStagiaire): static
    {
        $this->nomStagiaire = $nomStagiaire;

        return $this;
    }

    public function getPrenomStagiaire(): ?string
    {
        return $this->prenomStagiaire;
    }

    public function setPrenomStagiaire(string $prenomStagiaire): static
    {
        $this->prenomStagiaire = $prenomStagiaire;

        return $this;
    }

    public function getEmailStagiaire(): ?string
    {
        return $this->emailStagiaire;
    }

    public function setEmailStagiaire(string $emailStagiaire): static
    {
        $this->emailStagiaire = $emailStagiaire;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): static
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getDateNaissanceFr(): ?string
    {
        return $this->dateNaissance->format("d/m/Y");
    }

    public function getAge(): ?string
    {
        $now = new \DateTime();
        $interval = $this->dateNaissance->diff($now);
        return $interval->format('%Y');
    }


    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection<int, Session>
     */
    public function getSessions(): Collection
    {
        return $this->Sessions;
    }

    public function addSession(Session $session): static
    {
        if (!$this->Sessions->contains($session)) {
            $this->Sessions->add($session);
        }

        return $this;
    }

    public function removeSession(Session $session): static
    {
        $this->Sessions->removeElement($session);

        return $this;
    }

    public function __toString()
    {
        return $this->getNomStagiaire() . " " . $this->getPrenomStagiaire();
    }
}
