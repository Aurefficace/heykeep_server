<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class Categorie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Space", inversedBy="categorie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_space;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="categories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_owner;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="id_cat_parent")
     * @ORM\JoinColumn(nullable=true)
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Categorie", mappedBy="categorie")
     */
    private $id_cat_parent;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isarchiv;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Bloc")
     */
    private $id_bloc;

    public function __construct()
    {
        $this->id_cat_parent = new ArrayCollection();
        $this->id_bloc = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->created_date;
    }

    public function setCreatedDate(\DateTimeInterface $created_date): self
    {
        $this->created_date = $created_date;

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

    public function getIdOwner(): ?User
    {
        return $this->id_owner;
    }

    public function setIdOwner(?User $id_owner): self
    {
        $this->id_owner = $id_owner;

        return $this;
    }

    public function getCategorie(): ?self
    {
        return $this->categorie;
    }

    public function setCategorie(?self $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getIdCatParent(): Collection
    {
        return $this->id_cat_parent;
    }

    public function addIdCatParent(self $idCatParent): self
    {
        if (!$this->id_cat_parent->contains($idCatParent)) {
            $this->id_cat_parent[] = $idCatParent;
            $idCatParent->setCategorie($this);
        }

        return $this;
    }

    public function removeIdCatParent(self $idCatParent): self
    {
        if ($this->id_cat_parent->contains($idCatParent)) {
            $this->id_cat_parent->removeElement($idCatParent);
            // set the owning side to null (unless already changed)
            if ($idCatParent->getCategorie() === $this) {
                $idCatParent->setCategorie(null);
            }
        }

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getIsarchiv(): ?bool
    {
        return $this->isarchiv;
    }

    public function setIsarchiv(bool $isarchiv): self
    {
        $this->isarchiv = $isarchiv;

        return $this;
    }

    /**
     * @return Collection|Bloc[]
     */
    public function getIdBloc(): Collection
    {
        return $this->id_bloc;
    }

    public function addIdBloc(Bloc $idBloc): self
    {
        if (!$this->id_bloc->contains($idBloc)) {
            $this->id_bloc[] = $idBloc;
        }

        return $this;
    }

    public function removeIdBloc(Bloc $idBloc): self
    {
        if ($this->id_bloc->contains($idBloc)) {
            $this->id_bloc->removeElement($idBloc);
        }

        return $this;
    }
}
