<?php

namespace App\Controller;

use App\Entity\Licorne;
use App\Entity\Choix;
use App\Entity\Scenario;
use App\Repository\ChoixRepository;
use App\Repository\LicorneRepository;
use App\Repository\ScenarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PalierController extends AbstractController
{
    #[Route('/palier/{id}', name: 'app_palier')]
    public function index(ScenarioRepository $sr,LicorneRepository $lr,string $id): Response
    {
        //SCENARIOS
        // $scenario = $repertoire->find(random_int(0,$em->getRepository(Scenario::class)->count([])));
        $scenario = $sr->find(3);
       
        //LICORNE
        session_start();
        $_SESSION['idLicorne']=$id;
        $l = new Licorne();
        $l = $lr->find($id);

        return $this->render('palier/index.html.twig', [
            'scenario' => $scenario,
            'licorne' => $l
        ]);
    }
    
    #[Route('/palier/choix/{id}', name: 'app_consequence')]
    public function consequence(Choix $id,ChoixRepository $c,LicorneRepository $lr,ScenarioRepository $sr):Response{

        $monChoix = $c->find($id);
        $consequence =$monChoix->parseConsequence();
        $l = new Licorne();
        $l=$l->licorneEnJeu($lr);

        switch($consequence[0]){
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
        $s = new Scenario();
        $s->randomScenario($sr,2);
        return $this->render('palier/index.html.twig',[
            'scenario' => $s,
            'licorne' => $l
        ]);
    }

    
}
