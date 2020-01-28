<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
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
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_date;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Message", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_message_parent;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Discussion")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_discussion;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function getUpdatedDate(): ?\DateTimeInterface
    {
        return $this->updated_date;
    }

    public function setUpdatedDate(?\DateTimeInterface $updated_date): self
    {
        $this->updated_date = $updated_date;

        return $this;
    }

    public function getIdMessageParent(): ?self
    {
        return $this->id_message_parent;
    }

    public function setIdMessageParent(self $id_message_parent): self
    {
        $this->id_message_parent = $id_message_parent;

        return $this;
    }

    public function getIdDiscussion(): ?Discussion
    {
        return $this->id_discussion;
    }

    public function setIdDiscussion(?Discussion $id_discussion): self
    {
        $this->id_discussion = $id_discussion;

        return $this;
    }
}
