<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BookingRepository::class)]
class Booking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?\DateTime $datetime = null;

    #[ORM\Column(type: 'string', length: 25)]
    #[Assert\NotBlank(
        message: 'Champs obligatoire',
    )]
    #[Assert\Length(min: 2, max: 25)]
    #[Assert\Type(type: 'alpha')]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(
        message: 'Champs obligatoire',
    )]
    #[Assert\Email(
        message: 'Veuillez enter une adresse e-mail valide',
    )]
    private ?string $email = null;

    #[ORM\Column(length: 15)]
    #[Assert\NotBlank(
        message: 'Champs obligatoire',
    )]
    #[Assert\Type(type: 'digit')]
    private ?string $phone = null;

    #[ORM\Column]
    #[Assert\NotBlank(
        message: 'Champs obligatoire',
    )]
    #[Assert\LessThan(16)]
    #[Assert\Positive]
    private ?int $guests = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatetime(): ?\DateTime
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTime $datetime): static
    {
        $this->datetime = $datetime;

        return $this;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getGuests(): ?int
    {
        return $this->guests;
    }

    public function setGuests(int $guests): static
    {
        $this->guests = $guests;

        return $this;
    }
}
