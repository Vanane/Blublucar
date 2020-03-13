<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrajetRepository")
 */
class Trajet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="trajets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $conducteur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Destination", inversedBy="trajets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pointDepart;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Destination", inversedBy="trajets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pointArrivee;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tempsTrajet;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPlaces;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vehicule;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $options = [];

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentaire", mappedBy="trajet", orphanRemoval=true)
     */
    private $commentaires;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="trajet", orphanRemoval=true)
     */
    private $reservations;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getConducteur(): ?User
    {
        return $this->conducteur;
    }

    public function setConducteur(?User $conducteur): self
    {
        $this->conducteur = $conducteur;

        return $this;
    }

    public function getPointDepart(): ?Destination
    {
        return $this->pointDepart;
    }

    public function setPointDepart(?Destination $pointDepart): self
    {
        $this->pointDepart = $pointDepart;

        return $this;
    }

    public function getPointArrivee(): ?Destination
    {
        return $this->pointArrivee;
    }

    public function setPointArrivee(?Destination $pointArrivee): self
    {
        $this->pointArrivee = $pointArrivee;

        return $this;
    }

    public function getTempsTrajet(): ?int
    {
        return $this->tempsTrajet;
    }

    public function setTempsTrajet(?int $tempsTrajet): self
    {
        $this->tempsTrajet = $tempsTrajet;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getNbPlaces(): ?int
    {
        return $this->nbPlaces;
    }

    public function setNbPlaces(int $nbPlaces): self
    {
        $this->nbPlaces = $nbPlaces;

        return $this;
    }

    public function getVehicule(): ?string
    {
        return $this->vehicule;
    }

    public function setVehicule(string $vehicule): self
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    public function getOptions(): ?array
    {
        return $this->options;
    }

    public function setOptions(?array $options): self
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setTrajet($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getTrajet() === $this) {
                $commentaire->setTrajet(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setTrajet($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->contains($reservation)) {
            $this->reservations->removeElement($reservation);
            // set the owning side to null (unless already changed)
            if ($reservation->getTrajet() === $this) {
                $reservation->setTrajet(null);
            }
        }

        return $this;
    }
}
