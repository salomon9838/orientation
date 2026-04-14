<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class Etablissement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length:255)]
    private ?string $nom = null;

    #[ORM\Column(length:255)]
    private ?string $adresse = null;

    #[ORM\Column(length:255)]
    private ?string $ville = null;

    #[ORM\Column(length:255)]
    private ?string $telephone = null;

    #[ORM\Column(length:255)]
    private ?string $email = null;

    #[ORM\OneToMany(mappedBy: "etablissement", targetEntity: Filiere::class)]
    private Collection $filieres;

    #[ORM\OneToMany(mappedBy: "etablissement", targetEntity: Evenement::class)]
    private Collection $evenements;

    public function __construct()
    {
        $this->filieres = new ArrayCollection();
        $this->evenements = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }

    public function getNom(): ?string { return $this->nom; }
    public function setNom(string $nom): self { $this->nom = $nom; return $this; }

    public function getAdresse(): ?string { return $this->adresse; }
    public function setAdresse(string $adresse): self { $this->adresse = $adresse; return $this; }

    public function getVille(): ?string { return $this->ville; }
    public function setVille(string $ville): self { $this->ville = $ville; return $this; }

    public function getTelephone(): ?string { return $this->telephone; }
    public function setTelephone(string $telephone): self { $this->telephone = $telephone; return $this; }

    public function getEmail(): ?string { return $this->email; }
    public function setEmail(string $email): self { $this->email = $email; return $this; }

    public function getFilieres(): Collection { return $this->filieres; }

    public function addFiliere(Filiere $filiere): self {
        if (!$this->filieres->contains($filiere)) {
            $this->filieres[] = $filiere;
            $filiere->setEtablissement($this);
        }
        return $this;
    }

    public function removeFiliere(Filiere $filiere): self {
        if ($this->filieres->removeElement($filiere)) {
            if ($filiere->getEtablissement() === $this) {
                $filiere->setEtablissement(null);
            }
        }
        return $this;
    }

    public function getEvenements(): Collection { return $this->evenements; }

    public function addEvenement(Evenement $evenement): self {
        if (!$this->evenements->contains($evenement)) {
            $this->evenements[] = $evenement;
            $evenement->setEtablissement($this);
        }
        return $this;
    }

    public function removeEvenement(Evenement $evenement): self {
        if ($this->evenements->removeElement($evenement)) {
            if ($evenement->getEtablissement() === $this) {
                $evenement->setEtablissement(null);
            }
        }
        return $this;
    }
}