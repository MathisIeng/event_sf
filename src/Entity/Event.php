<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $start_time = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $end_time = null;

    #[ORM\Column]
    private ?int $room_id = null;

    #[ORM\Column]
    private ?int $animator_id = null;

    #[ORM\Column]
    private ?int $category_id = null;

    #[ORM\ManyToOne(targetEntity: Room::class, inversedBy: "events")]
    #[ORM\JoinColumn(nullable: false, onDelete: "cascade")]
    private ?Room $room = null;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: "events")]
    #[ORM\JoinColumn(nullable: false, onDelete: "cascade")]
    private ?Category $category = null;

    #[ORM\ManyToOne(targetEntity: Animator::class, inversedBy: "events")]
    #[ORM\JoinColumn(nullable: false, onDelete: "cascade")]
    private ?Animator $animator = null;

    public function getRoom(): ?Room {

        return $this->room;
    }

    public function setRoom(?Room $room): self {

        $this->room = $room;
        return $this;
    }

    public function getCategory(): ?Category {

        return $this->category;
    }

    public function setCategory(?Category $category): self {

        $this->category = $category;
        return $this;
    }

    public function getAnimator(): ?Animator {

        return $this->animator;
    }

    public function setAnimator(?Animator $animator): self {

        $this->animator = $animator;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->start_time;
    }

    public function setStartTime(\DateTimeInterface $start_time): static
    {
        $this->start_time = $start_time;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->end_time;
    }

    public function setEndTime(\DateTimeInterface $end_time): static
    {
        $this->end_time = $end_time;

        return $this;
    }

    public function getRoomId(): ?int
    {
        return $this->room_id;
    }

    public function setRoomId(int $room_id): static
    {
        $this->room_id = $room_id;

        return $this;
    }

    public function getAnimatorId(): ?int
    {
        return $this->animator_id;
    }

    public function setAnimatorId(int $animator_id): static
    {
        $this->animator_id = $animator_id;

        return $this;
    }

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function setCategoryId(int $category_id): static
    {
        $this->category_id = $category_id;

        return $this;
    }
}
