<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255)]
    #[NotBlank(message: 'Veuillez entrer votre nom')]
    #[Length(
        min: 2, 
        minMessage: 'Votre nom doit contenir au moins {{ limit }} caractères', 
        max: 255, 
        maxMessage: 'Votre nom ne peut contenir plus de {{ limit }} caractères'
    )]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    #[NotBlank(message: 'Veuillez entrer votre prénom')]
    #[Length(
        min: 2, 
        minMessage: 'Votre prénom doit contenir au moins {{ limit }} caractères', 
        max: 255, 
        maxMessage: 'Votre prénom ne peut contenir plus de {{ limit }} caractères'
    )]
    private ?string $lastName = null;

    #[ORM\Column]
    #[NotBlank(message: 'Veuillez entrer votre âge')]
    private ?int $age = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Address $address = null;

    #[ORM\OneToOne(inversedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Contact $contact = null;

    #[ORM\OneToMany(
        mappedBy: 'user', 
        targetEntity: Experience::class, 
        cascade: ['persist', 'remove']
    )]
    private Collection $experience;

    public function __construct()
    {
        $this->id = Uuid::v4();
        $this->experience = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(?Contact $contact): static
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * @return Collection<int, Experience>
     */
    public function getExperience(): Collection
    {
        return $this->experience;
    }

    public function addExperience(Experience $experience): static
    {
        if (!$this->experience->contains($experience)) {
            $this->experience->add($experience);
            $experience->setUser($this);
        }
        
        return $this;
    }

    public function removeExperience(Experience $experience): static
    {
        if ($this->experience->removeElement($experience)) {
            if ($experience->getUser() === $this) {
                $experience->setUser(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->firstName . ' ' . $this->lastName;
    }
}
