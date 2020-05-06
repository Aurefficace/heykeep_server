<?php

namespace App\Entity;

use App\DBAL\Types\ListeElementType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ElementRepository")
 */
class Element
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @Assert\NotBlank
     * @ORM\Column(name="type", type="ListeElementType", nullable=false)
     * @DoctrineAssert\Enum(entity="App\DBAL\Types\ListeElementType")
     */
    private $type;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Bloc", inversedBy="element", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $bloc;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getBloc(): ?Bloc
    {
        return $this->bloc;
    }

    public function setBloc(Bloc $bloc): self
    {
        $this->bloc = $bloc;

        return $this;
    }
}
