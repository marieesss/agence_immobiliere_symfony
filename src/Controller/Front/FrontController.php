<?php

namespace App\Controller\Front;

use App\Repository\AgenceRepository;
use App\Repository\EmployeRepository;
use App\Repository\LogementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    #[Route('/', name: 'app_front')]
    public function index(LogementRepository $logementRepository, EmployeRepository $employeRepository, AgenceRepository $agenceRepository): Response
    {
        $results = $logementRepository->findBy(array(),array('id'=>'DESC'));

        return $this->render('front/front/index.html.twig', [
            'logements' => $logementRepository->findBy(array(), array('id'=>'desc')),
            'employes' => $employeRepository->findAll(),
            'agences' => $agenceRepository->findAll(),
        ]);
    }
}
