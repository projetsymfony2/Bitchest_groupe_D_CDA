<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class PortfolioController extends AbstractController
{
    #[Route('/portfolio', name: 'app_portfolio')]
    #[IsGranted("ROLE_USER")]
    public function index(): Response
    {
        $user = $this->getUser(); 
        
        
        $balance = $user->getBalance();

        
        
        return $this->render('portfolio/index.html.twig', [
            'balance' => $balance,
            'portfolioEntries' => [], 
        ]);
    }
}
