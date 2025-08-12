<?php

namespace App\Entity;

use App\Repository\AffectationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AffectationRepository::class)]
class Affectation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_affectation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_retour = null;

    #[ORM\ManyToOne(inversedBy: 'affectations')]
    private ?Materiel $Materiel = null;

    #[ORM\ManyToOne(inversedBy: 'affectations')]
    private ?User $User = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAffectation(): ?\DateTime
    {
        return $this->date_affectation;
    }

    public function setDateAffectation(\DateTime $date_affectation): static
    {
        $this->date_affectation = $date_affectation;

        return $this;
    }

    public function getDateRetour(): ?\DateTime
    {
        return $this->date_retour;
    }

    public function setDateRetour(\DateTime $date_retour): static
    {
        $this->date_retour = $date_retour;

        return $this;
    }

    public function getMateriel(): ?Materiel
    {
        return $this->Materiel;
    }

    public function setMateriel(?Materiel $Materiel): static
    {
        $this->Materiel = $Materiel;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): static
    {
        $this->User = $User;

        return $this;
    }
}
