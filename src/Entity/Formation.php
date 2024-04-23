<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, Session>
     */
    #[ORM\OneToMany(targetEntity: Session::class, mappedBy: 'Formation')]
    private Collection $Sessions;

    public function __construct()
    {
        $this->Sessions = new ArrayCollection();
    }

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
            $session->setFormation($this);
        }

        return $this;
    }

    public function removeSession(Session $session): static
    {
        if ($this->Sessions->removeElement($session)) {
            // set the owning side to null (unless already changed)
            if ($session->getFormation() === $this) {
                $session->setFormation(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getTitreFormation();
    }
}
