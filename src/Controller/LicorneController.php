<?php

namespace App\Controller;

use App\Entity\Licorne;
use App\Form\LicorneType;
use App\Repository\LicorneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/licorne')]
class LicorneController extends AbstractController
{
    #[Route('/', name: 'app_licorne_index', methods: ['GET'])]
    public function index(LicorneRepository $licorneRepository): Response
    {
        return $this->render('licorne/index.html.twig', [
            'licornes' => $licorneRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_licorne_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $licorne = new Licorne();
        $form = $this->createForm(LicorneType::class, $licorne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($licorne);
            $entityManager->flush();

            return $this->redirectToRoute('app_licorne_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('licorne/new.html.twig', [
            'licorne' => $licorne,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_licorne_show', methods: ['GET'])]
    public function show(Licorne $licorne): Response
    {
        return $this->render('licorne/show.html.twig', [
            'licorne' => $licorne,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_licorne_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Licorne $licorne, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LicorneType::class, $licorne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_licorne_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('licorne/edit.html.twig', [
            'licorne' => $licorne,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_licorne_delete', methods: ['POST'])]
    public function delete(Request $request, Licorne $licorne, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$licorne->getId(), $request->request->get('_token'))) {
            $entityManager->remove($licorne);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_licorne_index', [], Response::HTTP_SEE_OTHER);
    }
}
