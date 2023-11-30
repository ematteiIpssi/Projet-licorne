<?php

namespace App\Entity;

use App\Repository\LicorneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LicorneRepository::class)]
class Licorne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $strenght = null;

    #[ORM\Column]
    private ?int $intelligence = null;

    #[ORM\Column]
    private ?int $esquive = null;

    #[ORM\Column]
    private ?int $pv = 10;

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

    public function getStrenght(): ?int
    {
        return $this->strenght;
    }

    public function setStrenght(int $strenght): static
    {
        $this->strenght = $strenght;

        return $this;
    }

    public function getIntelligence(): ?int
    {
        return $this->intelligence;
    }

    public function setIntelligence(int $intelligence): static
    {
        $this->intelligence = $intelligence;

        return $this;
    }

    public function getEsquive(): ?int
    {
        return $this->esquive;
    }

    public function setEsquive(int $esquive): static
    {
        $this->esquive = $esquive;

        return $this;
    }

    public function getPv(): ?int
    {
        return $this->pv;
    }

    public function setPv(int $pv): static
    {
        $this->pv = $pv;

        return $this;
    }

    public function licorneEnJeu(LicorneRepository $lr):Licorne
    {
        session_start();
        $l = new Licorne(); 
        $l = $lr->find($_SESSION['idLicorne']);
        return $l;
    }

    public function enVie(Licorne $l): bool{
        $c=new Choix();
        if(($l->getStrenght() == 0 && $l->getIntelligence()==0 && $l->getEsquive()==0) || ($l->getPv()<=0))
            return false;
        else if($l->getStrenght()<0 || $l->getIntelligence()<0 || $l->getEsquive()<0){
            return false;
        }
        else{
            return true;
        }
    }
}
