<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UserController extends AbstractController
{
    #[Route('/pageAdmin', name: 'page_admin')]
    #[IsGranted("ROLE_ADMIN", message:"Access Denied. You must be an administrator.")]
    public function accessAdminUsers(UserRepository $userRepository): Response
    {
        if (!$this->isGranted("ROLE_ADMIN")) {
            throw new AccessDeniedException("Access Denied. You must be an administrator.");
        }

        $users = $userRepository->findAll();

        return $this->render('admin/admin.html.twig', [
            'users' => $users,
        ]);
    }
}
