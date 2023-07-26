<?php

namespace App\Entity;

use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ContactRepository;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Validator\Constraints\Length;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private ?Uuid $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Length(
        max: 50, 
        maxMessage: 'Le numéro de téléphone ne doit pas dépasser {{ limit }} caractères', 
        min: 10, 
        minMessage: 'Le numéro de téléphone doit contenir au moins {{ limit }} caractères'
    )]
    private ?string $phone = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Length(
        max: 255, 
        maxMessage: 'L\'adresse email ne doit pas dépasser {{ limit }} caractères', 
        min: 5, 
        minMessage: 'L\'adresse email doit contenir au moins {{ limit }} caractères'
    )]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Url(message: 'L\'adresse Linkedin n\'est pas valide')]
    #[Length(
        max: 255, 
        maxMessage: 'L\'adresse Linkedin ne doit pas dépasser {{ limit }} caractères', 
        min: 5, 
        minMessage: 'L\'adresse Linkedin doit contenir au moins {{ limit }} caractères'
    )]
    private ?string $linkedin = null;

    //one to one user
    #[ORM\OneToOne(mappedBy: 'contact', targetEntity: User::class)]
    private ?User $user = null;

    public function __construct()
    {
        $this->id = Uuid::v4();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getLinkedin(): ?string
    {
        return $this->linkedin;
    }

    public function setLinkedin(?string $linkedin): static
    {
        $this->linkedin = $linkedin;

        return $this;
    }

    public function getUser(): ?User
    {
        if($this->user) {
            return $this->user;
        }
        return null;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
