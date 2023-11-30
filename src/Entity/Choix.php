<?php

namespace App\Entity;

use App\Repository\ChoixRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChoixRepository::class)]
class Choix
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'id_choix')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Scenario $id_scenario = null;

    #[ORM\Column(length: 255)]
    private ?string $consequences = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

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

    public function getIdScenario(): ?Scenario
    {
        return $this->id_scenario;
    }

    public function setIdScenario(?Scenario $id_scenario): static
    {
        $this->id_scenario = $id_scenario;

        return $this;
    }

    public function getConsequences(): ?string
    {
        return $this->consequences;
    }

    public function setConsequences(string $consequences): static
    {
        $this->consequences = $consequences;

        return $this;
    }
}
