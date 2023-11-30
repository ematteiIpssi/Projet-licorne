<?php

namespace App\Entity;

use App\Repository\ScenarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScenarioRepository::class)]
class Scenario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $palier = null;

    #[ORM\OneToMany(mappedBy: 'id_scenario', targetEntity: Choix::class)]
    private Collection $id_choix;

    public function __construct()
    {
        $this->id_choix = new ArrayCollection();
    }

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

    public function getPalier(): ?int
    {
        return $this->palier;
    }

    public function setPalier(int $palier): static
    {
        $this->palier = $palier;

        return $this;
    }

    /**
     * @return Collection<int, Choix>
     */
    public function getIdChoix(): Collection
    {
        return $this->id_choix;
    }

    public function addIdChoix(Choix $idChoix): static
    {
        if (!$this->id_choix->contains($idChoix)) {
            $this->id_choix->add($idChoix);
            $idChoix->setIdScenario($this);
        }

        return $this;
    }

    public function removeIdChoix(Choix $idChoix): static
    {
        if ($this->id_choix->removeElement($idChoix)) {
            // set the owning side to null (unless already changed)
            if ($idChoix->getIdScenario() === $this) {
                $idChoix->setIdScenario(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->id;
    }

    public function randomScenario(ScenarioRepository $sr,int $palier):Scenario{
       $s = $sr->findAll();
       $indexRandom = array_rand($s);
       return $s = $sr->find($indexRandom);
    }
}
