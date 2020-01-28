<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpaceRepository")
 */
class Space
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_date;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User")
     */
    private $id_owner;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Space", inversedBy="id_parent_space")
     * @ORM\JoinColumn(nullable=false)
     */
    private $level;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Space", mappedBy="level", orphanRemoval=false)
     */
    private $id_parent_space;

    /**
     * @ORM\Column(type="boolean")
     */
    private $actif;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Categorie", mappedBy="id_space")
     */
    private $categorie;

    public function __construct()
    {
        $this->id_owner = new ArrayCollection();
        $this->id_parent_space = new ArrayCollection();
        $this->categorie = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    /**
     * @return Collection|User[]
     */
    public function getIdOwner(): Collection
    {
        return $this->id_owner;
    }

    public function addIdOwner(User $idOwner): self
    {
        if (!$this->id_owner->contains($idOwner)) {
            $this->id_owner[] = $idOwner;
        }

        return $this;
    }

    public function removeIdOwner(User $idOwner): self
    {
        if ($this->id_owner->contains($idOwner)) {
            $this->id_owner->removeElement($idOwner);
        }

        return $this;
    }

    public function getLevel(): ?self
    {
        return $this->level;
    }

    public function setLevel(?self $level): self
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getIdParentSpace(): Collection
    {
        return $this->id_parent_space;
    }

    public function addIdParentSpace(self $idParentSpace): self
    {
        if (!$this->id_parent_space->contains($idParentSpace)) {
            $this->id_parent_space[] = $idParentSpace;
            $idParentSpace->setLevel($this);
        }

        return $this;
    }

    public function removeIdParentSpace(self $idParentSpace): self
    {
        if ($this->id_parent_space->contains($idParentSpace)) {
            $this->id_parent_space->removeElement($idParentSpace);
            // set the owning side to null (unless already changed)
            if ($idParentSpace->getLevel() === $this) {
                $idParentSpace->setLevel(null);
            }
        }

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

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

    /**
     * @return Collection|Categorie[]
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(Categorie $categorie): self
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie[] = $categorie;
            $categorie->setIdSpace($this);
        }

        return $this;
    }

    public function removeCategorie(Categorie $categorie): self
    {
        if ($this->categorie->contains($categorie)) {
            $this->categorie->removeElement($categorie);
            // set the owning side to null (unless already changed)
            if ($categorie->getIdSpace() === $this) {
                $categorie->setIdSpace(null);
            }
        }

        return $this;
    }
}
