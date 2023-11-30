<?php

namespace App\Controller;

use App\Entity\Scenario;
use App\Repository\ScenarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PalierController extends AbstractController
{
    #[Route('/palier', name: 'app_palier')]
    public function index(EntityManagerInterface $em, ScenarioRepository $repertoire): Response
    {
        // $scenario = $repertoire->find(random_int(0,$em->getRepository(Scenario::class)->count([])));
        $scenario = $repertoire->find(3);
        return $this->render('palier/index.html.twig', [
            'controller_name' => 'PalierController',
            'scenario' => $scenario
        ]);
    }
}
