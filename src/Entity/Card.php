<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Représente une carte de jeu avec une couleur et une valeur.
 */
class Card
{
    #[Assert\NotBlank]
    private string $color;

    #[Assert\NotBlank]
    private string $value;

    public function __construct(string $color, string $value)
    {
        $this->color = $color;
        $this->value = $value;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
