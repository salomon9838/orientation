<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class User
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length:255)]
    private ?string $nom = null;

    #[ORM\Column(length:255)]
    private ?string $email = null;

    #[ORM\Column(length:255)]
    private ?string $password = null;

    #[ORM\Column(length:50)]
    private ?string $role = "ROLE_USER";

}