<?php

declare(strict_types= 1);

namespace DealBreaker;

class Card
{
    private $suit = "";
    private $rank = "";

    public function __construct(string $rank, string $suit)
    {
        $this->rank = $rank;    
        $this->suit = $suit;
    }

    public function getSuit(): string
    {
        return $this->suit;
    }

    public function getRank(): string
    {
        return $this->rank;
    }

    public function __toString(): string
    {
        return $this->rank . $this->suit;
    }
}