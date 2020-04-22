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
    private $id_member;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Space", inversedBy="space_children")
     * @ORM\JoinColumn(nullable=true)
     */
    private $parent_space;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Space", mappedBy="parent_space", orphanRemoval=false)
     */
    private $space_children;

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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\user", inversedBy="spaces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_owner;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    public function __construct()
    {
        $this->id_member = new ArrayCollection();
        $this->space_children = new ArrayCollection();
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
        return $this->id_member;
    }

    public function addIdOwner(User $idOwner): self
    {
        if (!$this->id_member->contains($idOwner)) {
            $this->id_member[] = $idOwner;
        }

        return $this;
    }

    public function removeIdOwner(User $idOwner): self
    {
        if ($this->id_member->contains($idOwner)) {
            $this->id_member->removeElement($idOwner);
        }

        return $this;
    }

    public function getLevel(): ?self
    {
        return $this->parent_space;
    }

    public function setLevel(?self $parent_space): self
    {
        $this->parent_space = $parent_space;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getIdParentSpace(): Collection
    {
        return $this->space_children;
    }

    public function addIdParentSpace(self $idParentSpace): self
    {
        if (!$this->space_children->contains($idParentSpace)) {
            $this->space_children[] = $idParentSpace;
            $idParentSpace->setLevel($this);
        }

        return $this;
    }

    public function removeIdParentSpace(self $idParentSpace): self
    {
        if ($this->space_children->contains($idParentSpace)) {
            $this->space_children->removeElement($idParentSpace);
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

    public function setIdOwner(?user $id_owner): self
    {
        $this->id_owner = $id_owner;

        return $this;
    }
}
