<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\BlocRepository")
 */
class Bloc
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_owner;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Space", inversedBy="bloc")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_space;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isarchiv;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ispublic;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Element", mappedBy="bloc", cascade={"persist", "remove"})
     */
    private $element;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdOwner(): ?User
    {
        return $this->id_owner;
    }

    public function setIdOwner(?User $id_owner): self
    {
        $this->id_owner = $id_owner;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getIdSpace(): ?Space
    {
        return $this->id_space;
    }

    public function setIdSpace(?Space $id_space): self
    {
        $this->id_space = $id_space;

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

    public function getIspublic(): ?bool
    {
        return $this->ispublic;
    }

    public function setIspublic(bool $ispublic): self
    {
        $this->ispublic = $ispublic;

        return $this;
    }

    public function getElement(): ?Element
    {
        return $this->element;
    }

    public function setElement(Element $element): self
    {
        $this->element = $element;

        // set the owning side of the relation if necessary
        if ($element->getBloc() !== $this) {
            $element->setBloc($this);
        }

        return $this;
    }
}
