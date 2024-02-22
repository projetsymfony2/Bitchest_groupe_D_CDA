<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PortfolioController $portfolioController): Response
    {
        // Appeler l'action index() du PortfolioController pour récupérer les données du portefeuille
        $portfolioData = $portfolioController->index()->getContent();

        // Passer les données récupérées à la vue de la page d'accueil
        return $this->render('pages/home/home.html.twig', [
            'portfolioData' => $portfolioData,
        ]);
    }
}

