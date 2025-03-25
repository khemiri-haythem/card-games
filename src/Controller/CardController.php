<?php

namespace App\Controller;

use App\Service\CardService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Contrôleur pour la gestion et l'affichage des cartes.
 */
class CardController extends AbstractController
{
    #[Route('/cards', name: 'app_cards', methods: ['GET'])]
    public function index(CardService $cardService): Response
    {
        $hand = $cardService->generateHand();
        $sortedHand = $cardService->sortHand($hand);

        return $this->render('cards/index.html.twig', [
            'hand' => $hand,
            'sortedHand' => $sortedHand,
        ]);
    }
}
