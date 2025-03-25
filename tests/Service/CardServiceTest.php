<?php
namespace App\Tests\Service;

use App\Entity\Card;
use App\Service\CardService;
use PHPUnit\Framework\TestCase;

/**
 * Classe de test pour le service `CardService`.
 */
class CardServiceTest extends TestCase
{
    /**
     * @var CardService Service de gestion des cartes
     */
    private CardService $cardService;

    /**
     * Configuration avant chaque test.
     */
    protected function setUp(): void
    {
        $this->cardService = new CardService();
    }

    /**
     * Vérifie que la méthode `generateHand()` retourne bien 10 cartes.
     */
    public function testGenerateHandReturns10Cards(): void
    {
        $hand = $this->cardService->generateHand();

        $this->assertCount(10, $hand, "La main générée ne contient pas 10 cartes.");
    }

    /**
     * Vérifie que les cartes générées sont valides (couleur et valeur).
     */
    public function testGeneratedCardsAreValid(): void
    {
        $hand = $this->cardService->generateHand();
        $validColors = ['Carreaux', 'Cœur', 'Pique', 'Trèfle'];
        $validValues = ['AS', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'Valet', 'Dame', 'Roi'];

        foreach ($hand as $card) {
            $this->assertInstanceOf(Card::class, $card);
            $this->assertContains($card->getColor(), $validColors, "La couleur de la carte est invalide.");
            $this->assertContains($card->getValue(), $validValues, "La valeur de la carte est invalide.");
        }
    }

    /**
     * Vérifie que la méthode `sortHand()` trie correctement la main.
     */
    public function testSortHandSortsCardsCorrectly(): void
    {
        $hand = [
            new Card('Pique', '10'),
            new Card('Cœur', 'AS'),
            new Card('Carreaux', 'Dame'),
            new Card('Trèfle', '2'),
            new Card('Cœur', '9'),
        ];

        $sortedHand = $this->cardService->sortHand($hand);

        $expectedOrder = [
            new Card('Carreaux', 'Dame'),
            new Card('Cœur', 'AS'),
            new Card('Cœur', '9'),
            new Card('Pique', '10'),
            new Card('Trèfle', '2'),
        ];

        $this->assertEquals(
            array_map(fn($card) => (string) $card, $expectedOrder),
            array_map(fn($card) => (string) $sortedHand),
            "Le tri des cartes ne respecte pas l'ordre attendu."
        );
    }
}
