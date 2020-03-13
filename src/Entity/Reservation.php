<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Trajet", inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $trajet;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $passager;

    /**
     * @ORM\Column(type="boolean")
     */
    private $paye;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPersonnes;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPassager(): ?User
    {
        return $this->passager;
    }

    public function setPassager(?User $passager): self
    {
        $this->passager = $passager;

        return $this;
    }

    public function getPaye(): ?bool
    {
        return $this->paye;
    }

    public function setPaye(bool $paye): self
    {
        $this->paye = $paye;

        return $this;
    }

    public function getNbPersonnes(): ?int
    {
        return $this->nbPersonnes;
    }

    public function setNbPersonnes(int $nbPersonnes): self
    {
        $this->nbPersonnes = $nbPersonnes;

        return $this;
    }
}
