<?php
declare(strict_types= 1);

namespace DealBreaker;

use DealBreaker\DeckOfCards;
class Game
{
    private $deck;
    private const CARD_RANKING = [
        "2" => 2,
        "3"=> 3,
        "4"=> 4,
        "5"=> 5,
        "6"=> 6,
        "7"=> 7,
        "8"=> 8,
        "9"=> 9,
        "10"=> 10,
        "J"=> 11,
        "Q"=> 12,
        "K"=> 13,
        "A" => 14,
    ];

    private $dealtCards;
    private $minValue;
    private $maxValue;
    private $playerCard;

    public function __construct()
    {
        $this->deck = new DeckOfCards();
    }

    public function dealTwoCards(): array
    {
        $this->dealtCards[0] = $this->deck->dealCard();
        $this->dealtCards[1] = $this->deck->dealCard();
        $this->handleNullCards();
        return $this->handleReturnArrayForDealTwoCards();
    }

    private function handleReturnArrayForDealTwoCards(): array
    {
        if (self::CARD_RANKING[$this->dealtCards[0]->getRank()] == self::CARD_RANKING[$this->dealtCards[1]->getRank()]) {
            return [
                "card_1" => $this->dealtCards[0],
                "card_2" => $this->dealtCards[1],
                'pair' => true
            ];
        }
        return [
            "card_1" => $this->dealtCards[0],
            "card_2" => $this->dealtCards[1],
            'pair' => false
        ];
    }

    private function handleNullCards(): void
    {
        if ($this->dealtCards[0] === null || $this->dealtCards[1] === null) {
            $this->deck->resetDeck();
            $this->dealtCards[0] = $this->deck->dealCard();
            $this->dealtCards[1] = $this->deck->dealCard();
        }
    }

    public function getPlayerCard(): Card
    {
        $playerCard = $this->deck->dealCard();
        if ($playerCard === null) {
            $this->deck->resetDeck();
            $playerCard = $this->deck->dealCard();
        }
        $this->playerCard = $playerCard;
        return $this->playerCard;
    }

    public function determineOutcome(string $choice = null)
    {
        $this->determineMinAndMaxValue();
        if ($choice != null) {
            if ($choice == 'high' && self::CARD_RANKING[$this->playerCard->getRank()] > $this->minValue && self::CARD_RANKING[$this->playerCard->getRank()] > $this->maxValue) {
                return 'win_pair';
            } else if ($choice == 'low' && self::CARD_RANKING[$this->playerCard->getRank()] < $this->minValue && self::CARD_RANKING[$this->playerCard->getRank()] < $this->maxValue) {
                return 'win_pair';
            } else {
                return 'lose_match';
            }
        }
        if (($this->minValue < self::CARD_RANKING[$this->playerCard->getRank()]) && (self::CARD_RANKING[$this->playerCard->getRank()] < $this->maxValue)) {
            return 'win_inbetween';
        } else {
            return 'lose_match';
        }
    }

    private function determineMinAndMaxValue(): void
    {
        $this->minValue = min(self::CARD_RANKING[$this->dealtCards[0]->getRank()], self::CARD_RANKING[$this->dealtCards[1]->getRank()]);
        $this->maxValue = max(self::CARD_RANKING[$this->dealtCards[0]->getRank()], self::CARD_RANKING[$this->dealtCards[1]->getRank()]);
    }

    public function getDealtCards(): array
    {
        return $this->dealtCards;
    }
}