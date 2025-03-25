<?php

namespace App\Service;

use App\Entity\Card;

/**
 * Service responsable de la gestion des cartes.
 */
class CardService
{
    private const COLORS = ['Carreaux', 'Cœur', 'Pique', 'Trèfle'];
    private const VALUES = ['AS', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'Valet', 'Dame', 'Roi'];

    /**
     * Génère une main de 10 cartes aléatoires.
     *
     * @return Card[]
     */
    public function generateHand(int $size = 10): array
    {
        $cards = [];

        foreach (self::COLORS as $color) {
            foreach (self::VALUES as $value) {
                $cards[] = new Card($color, $value);
            }
        }

        shuffle($cards);

        return array_slice($cards, 0, $size);
    }

    /**
     * Trie une main de cartes selon l'ordre des couleurs et des valeurs.
     *
     * @param Card[] $hand
     * @return Card[]
     */
    public function sortHand(array $hand): array
    {
        usort($hand, function (Card $a, Card $b) {
            $colorOrder = array_flip(self::COLORS);
            $valueOrder = array_flip(self::VALUES);

            return $colorOrder[$a->getColor()] <=> $colorOrder[$b->getColor()]
                ?: $valueOrder[$a->getValue()] <=> $valueOrder[$b->getValue()];
        });
        return $hand;
    }
}
