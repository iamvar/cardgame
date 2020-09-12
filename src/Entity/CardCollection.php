<?php
declare(strict_types=1);

namespace Iamvar\CardGame\Entity;


use Iamvar\CardGame\Exception\EmptyCardCollectionException;

class CardCollection
{
    private array $cards;

    public function __construct(Card ...$cards)
    {
        $this->cards = $cards;
    }

    public function lookCard(): Card
    {
        $this->checkCardsExistence();
        return $this->cards[array_key_last($this->cards)];
    }

    public function pickCard(): Card
    {
        $this->checkCardsExistence();
        return array_pop($this->cards);
    }

    public function shuffle(): self
    {
        shuffle($this->cards);
        return $this;
    }

    private function checkCardsExistence(): void
    {
        if (empty($this->cards)) {
            throw new EmptyCardCollectionException('Cards has been finished');
        }
    }
}