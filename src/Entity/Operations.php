<?php

namespace App\Entity;

use App\Repository\OperationsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=OperationsRepository::class)
 */
class Operations
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Champs obligatoire")
     * @Assert\Length(min=10, minMessage="Minimum 10 caractères")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Clients::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Client;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Categories;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="operations")
     */
    private $Users;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Champs obligatoire")
     * @Assert\Length(min=5, minMessage="Minimum 5 caractères")
     */
    private $titre;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getClient(): ?Clients
    {
        return $this->Client;
    }

    public function setClient(?Clients $Client): self
    {
        $this->Client = $Client;

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->Categories;
    }

    public function setCategories(?Categories $Categories): self
    {
        $this->Categories = $Categories;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->Users;
    }

    public function setUsers(?Users $Users): self
    {
        $this->Users = $Users;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): self
    {
        $this->status = $status;

        return $this;
    }
}
