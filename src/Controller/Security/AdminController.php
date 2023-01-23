<?php

namespace App\Controller\Security;

use App\Repository\AgenceRepository;
use App\Repository\EmployeRepository;
use App\Repository\LogementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(LogementRepository $logementRepository, EmployeRepository $employeRepository, AgenceRepository $agenceRepository): Response
    {
        return $this->render('security/admin.html.twig', [
            'logements' => $logementRepository->findAll(),
            'employes' => $employeRepository->findAll(),
            'agences' => $agenceRepository->findAll(),
        ]);
    }
}
