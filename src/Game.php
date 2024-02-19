<?php
declare(strict_types= 1);

namespace DealBreaker;

use DealBreaker\Card;

const CARD_VALUES = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];
/*
 * Card Faces
 * 
 * D - Diamond
 * C - Club
 * H - Heart
 * S - Spade
 */
const CARD_FACES = ['D', 'C', 'H', 'S'];

class Game
{
    private $minNumber;
    private $maxNumber;
    private $MAX_RANGE;
    private $MIN_RANGE;
    private $cards;
    public function __construct()
    {
        $this->initializeCards();
    }

    private function initializeCards()
    {
        foreach(CARD_FACES as $cardFace) {
            foreach(CARD_VALUES as $cardValue) {
                $this->cards[] = new Card($cardValue, $cardFace);
            }
        }
    }
}