<?php

declare(strict_types=1);

use Kilo\Solid\Client\Client;
use Kilo\Solid\Workout\Level;
use Kilo\Solid\Repositories\WorkoutRepository;

class Workout
{
    public function __construct()
    {
        $this->workoutRepository = new WorkoutRepository();
    }

    public function getWorkoutIdByScore(Level $level): ?int
    {
        $level = $level->getClientLevel();

        switch ($level) {
            case Level::WALKER:
                $workouts = $this->workoutRepository->getWorkoutByLevelRange(Client::WALKER_RANGE);
                break;
            case Level::BEGINNER:
                $workouts = $this->workoutRepository->getWorkoutByLevelRange(Client::BEGINNER_RANGE);
                break;
            case Level::INTERMEDIATE:
                $workouts = $this->workoutRepository->getWorkoutByLevelRange(Client::INTERMEDIATE_RANGE);
                break;
            case Level::ADVANCED:
                $workouts = $this->workoutRepository->getWorkoutByLevelRange(Client::ADVANCED_RANGE);
                break;
            case Level::PRO:
                $workouts = $this->workoutRepository->getWorkoutByLevelRange(Client::PRO_RANGE);
                break;
            default:
                throw new InvalidArgumentException('Workout by this score doesn\'t exist!');
        }

        return $workouts[array_rand($workouts)];
    }
}
