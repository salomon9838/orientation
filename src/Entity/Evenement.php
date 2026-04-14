<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length:255)]
    private ?string $titre = null;

    #[ORM\Column(type:"text")]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column(length:255)]
    private ?string $lieu = null;

    #[ORM\ManyToOne(inversedBy: "evenements")]
    private ?Etablissement $etablissement = null;

    #[ORM\ManyToMany(targetEntity: Utilisateur::class, mappedBy: "evenements")]
    private Collection $utilisateurs;

    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }

    public function getTitre(): ?string { return $this->titre; }
    public function setTitre(string $titre): self { $this->titre = $titre; return $this; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(string $description): self { $this->description = $description; return $this; }

    public function getDateDebut(): ?\DateTimeInterface { return $this->dateDebut; }
    public function setDateDebut(\DateTimeInterface $dateDebut): self { $this->dateDebut = $dateDebut; return $this; }

    public function getDateFin(): ?\DateTimeInterface { return $this->dateFin; }
    public function setDateFin(\DateTimeInterface $dateFin): self { $this->dateFin = $dateFin; return $this; }

    public function getLieu(): ?string { return $this->lieu; }
    public function setLieu(string $lieu): self { $this->lieu = $lieu; return $this; }

    public function getEtablissement(): ?Etablissement { return $this->etablissement; }
    public function setEtablissement(?Etablissement $etablissement): self { $this->etablissement = $etablissement; return $this; }

    public function getUtilisateurs(): Collection { return $this->utilisateurs; }
}