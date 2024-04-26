<?php

namespace App\Entity;

use App\Repository\FormateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, Session>
     */
    #[ORM\OneToMany(targetEntity: Session::class, mappedBy: 'Formateur')]
    private Collection $Sessions;

    public function __construct()
    {
        $this->Sessions = new ArrayCollection();
    }

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

    public function getFullnameFormateur(): ?string
    {
        return $this->getNomFormateur() . ' ' . $this->getPrenomFormateur();
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
            $session->setFormateur($this);
        }

        return $this;
    }

    public function removeSession(Session $session): static
    {
        if ($this->Sessions->removeElement($session)) {
            // set the owning side to null (unless already changed)
            if ($session->getFormateur() === $this) {
                $session->setFormateur(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getNomFormateur() . " " . $this->getPrenomFormateur();
    }
}
