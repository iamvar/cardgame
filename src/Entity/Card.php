<?php
declare(strict_types=1);

namespace Iamvar\CardGame\Entity;

use Iamvar\CardGame\Exception\InvalidCardException;

class Card
{
    public const RANK_ACE = 'A';
    public const RANK_QUEEN = 'Q';
    public const RANK_KING = 'K';
    public const RANK_JACK = 'J';

    public const SUIT_CLUBS = 'clubs';
    public const SUIT_DIAMONDS = 'diamonds';
    public const SUIT_HEARTS = 'hearts';
    public const SUIT_SPADES = 'spades';

    private string $rank;
    private string $suit;

    public function __construct(string $rank, string $suit)
    {
        $this->setRank($rank)
            ->setSuit($suit);
    }

    private function setSuit(string $suit): self
    {
        if (!in_array($suit, self::getValidSuits())) {
            throw new InvalidCardException("Unknown suit '{$suit}'");
        }

        $this->suit = $suit;
        return $this;
    }

    public static function getValidSuits(): array
    {
        return [
            self::SUIT_CLUBS,
            self::SUIT_DIAMONDS,
            self::SUIT_HEARTS,
            self::SUIT_SPADES,
        ];
    }

    private function setRank(string $rank): self
    {
        if (!in_array($rank, self::getValidRanks())) {
            throw new InvalidCardException("Unknown rank '{$rank}'");
        }

        $this->rank = $rank;
        return $this;
    }

    public static function getValidRanks(): array
    {
        return array_map('strval', range(2, 10)) + [
                self::RANK_ACE,
                self::RANK_KING,
                self::RANK_QUEEN,
                self::RANK_JACK,
            ];
    }

    public function getRank(): string
    {
        return $this->rank;
    }

    public function getSuit(): string
    {
        return $this->suit;
    }
}