<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FavorisRepository")
 */
class Favoris
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
    private $id_user;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Bloc", cascade={"persist", "remove"})
     */
    private $id_bloc;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Categorie", cascade={"persist", "remove"})
     */
    private $id_cat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getIdBloc(): ?Bloc
    {
        return $this->id_bloc;
    }

    public function setIdBloc(?Bloc $id_bloc): self
    {
        $this->id_bloc = $id_bloc;

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
}
