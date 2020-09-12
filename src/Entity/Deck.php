<?php
declare(strict_types=1);

namespace Iamvar\CardGame\Entity;

class Deck
{
    private CardCollection $collection;

    public function __construct()
    {
        $collection = [];

        foreach (Card::getValidRanks() as $rank) {
            foreach (Card::getValidSuits() as $suit) {
                $collection[] = new Card($rank, $suit);
            }
        }

        $this->collection = new CardCollection(...$collection);
    }

    public function getCollection(): CardCollection
    {
        return $this->collection;
    }
}