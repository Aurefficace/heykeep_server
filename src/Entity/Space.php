<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpaceRepository")
 */
class Space
{
    #region Attributs
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
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="spacesMember")
     * @ORM\JoinTable(name="space_user")
     */
    private $idMember;

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

    /**
     * @var UploadedFile|null
     * @Assert\File(
     *     maxSize="6000000"
     * )
     */
    private $imagefile;
    #endregion Attributs

    /**
     * @var ?User
     */
    private $tmpUser;


    public function __construct()
    {
        $this->idMember = new ArrayCollection();
        $this->space_children = new ArrayCollection();
        $this->categorie = new ArrayCollection();
    }

    #region Getters and Setters
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

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getIdMember(): Collection
    {
        return $this->idMember;
    }

    public function addIdMember(User $idMember): self
    {
        if (!$this->idMember->contains($idMember)) {
            $this->idMember[] = $idMember;
        }

        return $this;
    }

    public function removeIdMember(User $idMember): self
    {
        if ($this->idMember->contains($idMember)) {
            $this->idMember->removeElement($idMember);
        }

        return $this;
    }

    public function getParentSpace(): ?self
    {
        return $this->parent_space;
    }

    public function setParentSpace(?self $parent_space): self
    {
        $this->parent_space = $parent_space;

        return $this;
    }

    /**
     * @return Collection|Space[]
     */
    public function getSpaceChildren(): Collection
    {
        return $this->space_children;
    }

    public function addSpaceChild(Space $spaceChild): self
    {
        if (!$this->space_children->contains($spaceChild)) {
            $this->space_children[] = $spaceChild;
            $spaceChild->setParentSpace($this);
        }

        return $this;
    }

    public function removeSpaceChild(Space $spaceChild): self
    {
        if ($this->space_children->contains($spaceChild)) {
            $this->space_children->removeElement($spaceChild);
            // set the owning side to null (unless already changed)
            if ($spaceChild->getParentSpace() === $this) {
                $spaceChild->setParentSpace(null);
            }
        }

        return $this;
    }

    public function getIdOwner(): ?user
    {
        return $this->id_owner;
    }

    public function setIdOwner(?user $id_owner): self
    {
        $this->id_owner = $id_owner;

        return $this;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $imagefile
     */
    public function setImagefile(UploadedFile $imagefile = null)
    {
        $this->imagefile = $imagefile;
    }

    /**
     * Get file.
     *
     */
    public function getImagefile(): ?UploadedFile
    {
        return $this->imagefile;
    }

    public function getTmpUser()
    {
        return $this->tmpUser;
    }

    public function setTmpUser(?User $tmpUser): Space
    {
        $this->tmpUser = $tmpUser;
        return $this;
    }
    #endregion Getters and Setters
}
