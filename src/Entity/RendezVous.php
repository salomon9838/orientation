<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class RendezVous
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length:255)]
    private ?string $etudiant = null;

    #[ORM\Column(length:255)]
    private ?string $mentor = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;
        return $this;
    }

    public function getEtudiant(): ?string
    {
        return $this->etudiant;
    }

    public function setEtudiant(string $etudiant): static
    {
        $this->etudiant = $etudiant;
        return $this;
    }

    public function getMentor(): ?string
    {
        return $this->mentor;
    }

    public function setMentor(string $mentor): static
    {
        $this->mentor = $mentor;
        return $this;
    }
}