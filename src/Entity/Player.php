<?php
declare(strict_types=1);

namespace Iamvar\CardGame\Entity;

class Player
{
    private string $name;
    private int $score;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->score = 0;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function addScore(int $score): self
    {
        $this->score += $score;
        return $this;
    }
}