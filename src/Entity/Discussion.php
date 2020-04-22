<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DiscussionRepository")
 */
class Discussion
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Space")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_space;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ispublic;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User")
     */
    private $id_user;

    public function __construct()
    {
        $this->id_user = new ArrayCollection();
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

    public function getIdSpace(): ?Space
    {
        return $this->id_space;
    }

    public function setIdSpace(?Space $id_space): self
    {
        $this->id_space = $id_space;

        return $this;
    }

    public function getIspublic(): ?bool
    {
        return $this->ispublic;
    }

    public function setIspublic(bool $ispublic): self
    {
        $this->ispublic = $ispublic;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getIdUser(): Collection
    {
        return $this->id_user;
    }

    public function addIdUser(User $idUser): self
    {
        if (!$this->id_user->contains($idUser)) {
            $this->id_user[] = $idUser;
        }

        return $this;
    }

    public function removeIdUser(User $idUser): self
    {
        if ($this->id_user->contains($idUser)) {
            $this->id_user->removeElement($idUser);
        }

        return $this;
    }

}
