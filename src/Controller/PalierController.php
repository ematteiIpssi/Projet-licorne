<?php

namespace App\Controller;

use App\Entity\Licorne;
use App\Entity\Choix;
use App\Entity\Scenario;
use App\Repository\ChoixRepository;
use App\Repository\LicorneRepository;
use App\Repository\ScenarioRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\EntityManagerRegistry;

class PalierController extends AbstractController
{
    #[Route('/palier/{id}', name: 'app_palier')]
    public function index(ScenarioRepository $sr,LicorneRepository $lr,string $id): Response
    {
        $palier="1";
        //SCENARIO
        $s= (new Scenario())->randomScenario($sr,$palier);
        //LICORNE   
        session_start();
        $_SESSION['idLicorne']=$id;
        $l = $lr->find($id);

        return $this->render('palier/index.html.twig', [
            'scenario' => $s,
            'licorne' => $l,
            'palier' => $palier
        ]);
    }
    
    #[Route('/palier/choix/{id}/{palier}', name: 'app_consequence')]
    public function consequence(Choix $id,ChoixRepository $cr,LicorneRepository $lr,ScenarioRepository $sr, EntityManagerInterface $em,string $palier):Response{
        $palier=$palier+1;
        $consequence = ($cr->find($id))->parseConsequence();
        $l = (new Licorne())->licorneEnJeu(($lr));
        switch($consequence[1]){
            case 'i':
                $l->setIntelligence($l->getIntelligence()-$consequence[0]);
                break;
            case 's':
                $l->setStrenght($l->getStrenght()-$consequence[0]);
                break;
            case 'e':
                $l->setEsquive($l->getEsquive()-$consequence[0]);
                break;
            case 'p':
                $l->setPv($l->getPv()-$consequence[0]);
                break;
        }
        if(!$l->enVie($l)){
            $em->remove($l);
            $em->flush();
            return $this->render('palier/gameOver.html.twig');
        }
        $em->flush();
        if($palier>3){
            return $this->render('palier/win.html.twig');
        }
        $s = (new Scenario())->randomScenario($sr,$palier);
        return $this->render('palier/index.html.twig',[
            'scenario' => $s,
            'licorne' => $l,
            'palier'=> $palier
        ]);
    }    
}
