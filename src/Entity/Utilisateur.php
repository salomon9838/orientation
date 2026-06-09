<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Repository\UtilisateurRepository;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[ORM\Table(name: '`utilisateur`')]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $imageUrl = null;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\ManyToOne(inversedBy: "utilisateurs")]
    #[ORM\JoinColumn(nullable: true)]
    private ?Filiere $filiere = null;

    #[ORM\ManyToMany(targetEntity: Evenement::class, inversedBy: "utilisateurs")]
    private Collection $evenements;

    public function __construct()
    {
        $this->evenements = new ArrayCollection();
        $this->roles = ['ROLE_USER'];
    }

    public function getId(): ?int 
    { 
        return $this->id; 
    }

    public function getEmail(): ?string 
    { 
        return $this->email; 
    }

    public function setEmail(string $email): self 
    { 
        $this->email = $email; 
        return $this; 
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function getNom(): ?string 
    { 
        return $this->nom; 
    }

    public function setNom(string $nom): self 
    { 
        $this->nom = $nom; 
        return $this; 
    }

    public function getPrenom(): ?string 
    { 
        return $this->prenom; 
    }

    public function setPrenom(string $prenom): self 
    { 
        $this->prenom = $prenom; 
        return $this; 
    }

    public function getPassword(): ?string 
    { 
        return $this->password; 
    }

    public function setPassword(string $password): self 
    { 
        $this->password = $password; 
        return $this; 
    }

    public function getImageUrl(): ?string 
    { 
        return $this->imageUrl; 
    }

    public function setImageUrl(?string $imageUrl): self 
    { 
        $this->imageUrl = $imageUrl; 
        return $this; 
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        if (empty($roles)) {
            $roles[] = 'ROLE_USER';
        }
        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function addRole(string $role): self
    {
        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }
        return $this;
    }

    public function eraseCredentials(): void
    {
    }

    public function getFiliere(): ?Filiere 
    { 
        return $this->filiere; 
    }

    public function setFiliere(?Filiere $filiere): self 
    { 
        $this->filiere = $filiere; 
        return $this; 
    }

    public function getEvenements(): Collection 
    { 
        return $this->evenements; 
    }

    public function addEvenement(Evenement $evenement): self
    {
        if (!$this->evenements->contains($evenement)) {
            $this->evenements[] = $evenement;
        }
        return $this;
    }

    public function removeEvenement(Evenement $evenement): self
    {
        $this->evenements->removeElement($evenement);
        return $this;
    }
}