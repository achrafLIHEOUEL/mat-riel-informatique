<?php

namespace App\Entity;

use App\Repository\InterventionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InterventionRepository::class)]
class Intervention
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $typeIntervention = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_intervention = null;

    #[ORM\Column(length: 255)]
    private ?string $effectue_par = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeIntervention(): ?string
    {
        return $this->typeIntervention;
    }

    public function setTypeIntervention(string $typeIntervention): static
    {
        $this->typeIntervention = $typeIntervention;

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

    public function getDateIntervention(): ?\DateTime
    {
        return $this->date_intervention;
    }

    public function setDateIntervention(\DateTime $date_intervention): static
    {
        $this->date_intervention = $date_intervention;

        return $this;
    }

    public function getEffectuePar(): ?string
    {
        return $this->effectue_par;
    }

    public function setEffectuePar(string $effectue_par): static
    {
        $this->effectue_par = $effectue_par;

        return $this;
    }
}
