<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentaireRepository")
 */
class Commentaire
{
    public function __toString()
    {
        return $this->message;
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="commentaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $posteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $message;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     * min=0,
     * max=5,
     * minMessage="Note entre 0 et 5",
     * maxMessage="Note entre 0 et 5"
     * )
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Trajet", inversedBy="commentaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $trajet;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datePost;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPosteur(): ?User
    {
        return $this->posteur;
    }

    public function setPosteur(?User $posteur): self
    {
        $this->posteur = $posteur;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(float $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getTrajet(): ?Trajet
    {
        return $this->trajet;
    }

    public function setTrajet(?Trajet $trajet): self
    {
        $this->trajet = $trajet;

        return $this;
    }

    public function getDatePost(): ?\DateTimeInterface
    {
        return $this->datePost;
    }

    public function setDatePost(\DateTimeInterface $datePost): self
    {
        $this->datePost = $datePost;

        return $this;
    }
}
