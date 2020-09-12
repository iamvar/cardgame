<?php
declare(strict_types=1);

namespace Iamvar\CardGame\Service;

use Iamvar\CardGame\Entity\Card;
use Iamvar\CardGame\Entity\CardCollection;
use Iamvar\CardGame\Entity\Deck;
use Iamvar\CardGame\Entity\Player;

class TwentyOneService
{
    public const MAX_SCORE = 21;

    private CardCollection $cards;
    private array $players;

    public function __construct(Player ...$players)
    {
        $this->players = $players;
        $this->cards = (new Deck())->getCollection()->shuffle();
    }

    public function checkNextCardScore(): int
    {
        $rank = $this->cards->lookCard()->getRank();
        return $this->getScore($rank);
    }

    private function getScore(string $rank): int
    {
        switch ($rank) {
            case Card::RANK_JACK:
            case Card::RANK_QUEEN:
            case Card::RANK_KING:
                return 10;
            case Card::RANK_ACE:
                return 1;
            default:
                return (int)$rank;
        }
    }

    /** adds score to the specific player when he picks card from collection */
    public function pickCardForPlayer(Player $player): int
    {
        $rank = $this->cards->pickCard()->getRank();
        $score = $this->getScore($rank);
        $player->addScore($score);

        return $score;
    }

    public function getPlayers(): array
    {
        return $this->players;
    }

    /**
     * @return Player[]
     */
    public function getWinners(): array
    {
        $overtakersExcluded = array_filter($this->players, fn($p) => $p->getScore() <= self::MAX_SCORE);
        if (empty($overtakersExcluded)) {
            return [];
        }

        $bestScore = max(array_map(fn($p) => $p->getScore(), $overtakersExcluded));

        //get players with best score
        return array_filter($overtakersExcluded, fn($p) => $p->getScore() === $bestScore);
    }
}