<?php
declare(strict_types= 1);

namespace DealBreaker;

use DealBreaker\Card;

class DeckOfCards
{
    private const CARD_RANKS = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];
    private const CARD_SUITES = ['D', 'C', 'H', 'S'];

    private $deck;

    public function __construct()
    {
        $this->initializeCards();
        $this->shuffleDeck();
    }

    private function initializeCards()
    {
        foreach(self::CARD_SUITES as $suit) {
            foreach(self::CARD_RANKS as $rank) {
                $this->deck[] = new Card($rank, $suit);
            }
        }
    }

    public function resetDeck(): void
    {
        $this->deck = [];
        $this->initializeCards();
        $this->shuffleDeck();
    }

    public function shuffleDeck(): void
    {
        shuffle($this->deck);
    }

    public function dealCard(): Card|null
    {
        if (empty($this->deck)) {
            return null;
        }
        return array_pop($this->deck);
    }
}
