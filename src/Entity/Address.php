<?php

namespace App\Entity;

use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AddressRepository;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255)]
    #[NotBlank(message: 'Veuillez entrer le lot de votre batiment')]
    #[Length(
        min: 2, 
        minMessage: 'Le lot de votre batiment doit contenir au moins {{ limit }} caractères', 
        max: 255, 
        maxMessage: 'Le lot de votre batiment doit contenir au plus {{ limit }} caractères'
    )]
    private ?string $batch = null;

    #[ORM\Column(length: 255)]
    #[NotBlank(message: 'Veuillez entrer votre ville')]
    #[Length(
        min: 2, 
        minMessage: 'Votre ville doit contenir au moins {{ limit }} caractères', 
        max: 255,
        maxMessage: 'Votre ville doit contenir au plus {{ limit }} caractères'
    )]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    #[NotBlank(message: 'Veuillez entrer votre code postal')]
    #[Length(
        min: 2, 
        minMessage: 'Votre code postal doit contenir au moins {{ limit }} caractères', 
        max: 255, 
        maxMessage: 'Votre code postal doit contenir au plus {{ limit }} caractères'
    )]
    private ?string $postalCode = null;

    #[ORM\OneToOne(mappedBy: 'address', targetEntity: User::class)]
    private ?User $user = null;

    public function __construct()
    {
        $this->id = Uuid::v4();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getBatch(): ?string
    {
        return $this->batch;
    }

    public function setBatch(string $batch): static
    {
        $this->batch = $batch;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): static
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getUser(): ?User
    {
        if ($this->user) {
            return $this->user;
        }
    }
}
