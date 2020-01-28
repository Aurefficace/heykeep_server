<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubscriptionRepository")
 */
class Subscription
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_owner;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie")
     */
    private $id_cat;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Space")
     */
    private $id_space;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdOwner(): ?User
    {
        return $this->id_owner;
    }

    public function setIdOwner(?User $id_owner): self
    {
        $this->id_owner = $id_owner;

        return $this;
    }

    public function getIdCat(): ?Categorie
    {
        return $this->id_cat;
    }

    public function setIdCat(?Categorie $id_cat): self
    {
        $this->id_cat = $id_cat;

        return $this;
    }

    public function getIdSpace(): ?Space
    {
        return $this->id_space;
    }

    public function setIdSpace(?Space $id_space): self
    {
        $this->id_space = $id_space;

        return $this;
    }
}
