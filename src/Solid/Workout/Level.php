<?php

declare(strict_types=1);

namespace Kilo\Solid\Workout;

class Level
{
    private $score;

    public function __construct(int $score)
    {
        $this->score = $score;
    }

    public function isBeginner()
    {
        return Client::BEGINNER_RANGE[0] <= $this->score && $this->score <= Client::BEGINNER_RANGE[1];
    }

    public function isIntermediate()
    {
        return Client::INTERMEDIATE_RANGE[0] <= $this->score && $this->score <= Client::INTERMEDIATE_RANGE[1];
    }

    public function isAdvanced()
    {
        return Client::ADVANCED_RANGE[0] <= $this->score && $this->score <= Client::ADVANCED_RANGE[1];
    }

    public function isPro()
    {
        return Client::PRO_RANGE[0] <= $this->score && $this->score <= Client::PRO_RANGE[1];
    }
}
