<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InvitationRepository")
 */
class Invitation
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
    private $id_invitator;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Space", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_space;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $token;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_date;

    /**
     * @ORM\Column(type="json")
     */
    private $email_dest = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdInvitator(): ?User
    {
        return $this->id_invitator;
    }

    public function setIdInvitator(?User $id_invitator): self
    {
        $this->id_invitator = $id_invitator;

        return $this;
    }

    public function getIdSpace(): ?Space
    {
        return $this->id_space;
    }

    public function setIdSpace(Space $id_space): self
    {
        $this->id_space = $id_space;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

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

    public function getEmailDest(): ?array
    {
        return $this->email_dest;
    }

    public function setEmailDest(array $email_dest): self
    {
        $this->email_dest = $email_dest;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
