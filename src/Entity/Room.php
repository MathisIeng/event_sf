<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $capacity = null;

    #[ORM\ManyToOne(targetEntity: Establishment::class, inversedBy: "rooms")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Establishment $establishment = null;

    #[ORM\OneToMany(targetEntity: Event::class, mappedBy: "room")]
    private Collection $events;

    public function getEvents(): Collection {

        return $this->events;
    }

    public function setEvents(Collection $events): self {

        $this->events = $events;
        return $this;
    }

    public function getEstablishment(): ?Establishment {

        return $this->establishment;
    }

    public function setEstablishment(?Establishment $establishment): self {

        $this->establishment = $establishment;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): static
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getEstablishmentId(): ?int
    {
        return $this->establishment_id;
    }

    public function setEstablishmentId(int $establishment_id): static
    {
        $this->establishment_id = $establishment_id;

        return $this;
    }
}
