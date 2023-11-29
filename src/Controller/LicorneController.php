<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LicorneController extends AbstractController
{
    #[Route('/licorne', name: 'app_licorne')]
    public function index(): Response
    {
        return $this->render('licorne/index.html.twig', [
            'controller_name' => 'LicorneController',
        ]);
    }
}
