<?php

declare(strict_types=1);

namespace Kilo\Solid\Repositories;

use Kilo\Solid\TrainingPlan\Version;

class WorkoutPlanRepository
{
    private $version;

    private $score;

    public function __construct(Version $version, int $score)
    {
        $this->version = $version->getVersion($version);
        $this->score = $score;
    }

    public function getOneByVersionScoreAndCount(int $workoutCount): ?WorkoutPlan
    {
        return WorkoutPlan::where('training_plan->version', $this->version)
            ->where('running_level', $this->score)
            ->where('workout_count', $workoutCount)
            ->first();
    }

    public function getAllByVersionScoreAndCount(int $workoutCount): Collection
    {
        return WorkoutPlan::where('training_plan->version', $this->version)
            ->where('running_level', $this->score)
            ->where('workout_count', $workoutCount)
            ->get();
    }

    public function getByVersionAndScore(): ?WorkoutPlan
    {
        return WorkoutPlan::where('training_plan->version', $this->version)
            ->where('running_level', $this->score)
            ->first();
    }

    public function getByVersionAndCount(): ?WorkoutPlan
    {
        return WorkoutPlan::where('training_plan->version', $this->version)
            ->where('workout_count', $this->score)
            ->first();
    }
}
