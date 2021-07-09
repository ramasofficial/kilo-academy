<?php

declare(strict_types=1);

namespace Kilo\Solid\Repositories;

use RuntimeException;
use Kilo\Solid\Workout\Level;

class WorkoutRepository
{
    public function getRandomWorkout(): Workout
    {
        $workout = Workout::inRandomOrder()->first();

        if (!$this->hasWorkout($workout)) {
            throw new RuntimeException('No workout has been found.');
        }

        return $workout;
    }

    public function getRandomVisibleWorkout(): Workout
    {
        $workout = Workout::where('is_visible', true)->inRandomOrder()->first();

        if (!$this->hasWorkout($workout)) {
            throw new RuntimeException('No workout has been found.');
        }

        return $workout;
    }

    public function getWorkoutById(int $id): ?Workout
    {
        if (!$id) {
            return null;
        }

        return Workout::find($id);
    }

    public function getWorkoutByLevelRange(array $level): array
    {
        $workouts = Workout::whereBetween('level', $level)->pluck('id')->toArray();

        if (empty($workouts)) {
            return null;
        }

        return $workouts;
    }

    private function hasWorkout(Workout $workout): bool
    {
        if (!$workout) {
            return false;
        }

        return true;
    }

    public function getWorkoutIdByScore(Level $level): ?int
    {
        if ($level->isBeginner()) {
            $beginnerWorkouts = $this->getWorkoutByLevelRange(Client::BEGINNER_RANGE);

            return $beginnerWorkouts[array_rand($beginnerWorkouts)];
        } else if ($level->isIntermediate()) {
            $intermediateWorkouts = $this->getWorkoutByLevelRange(Client::INTERMEDIATE_RANGE);

            return $intermediateWorkouts[array_rand($intermediateWorkouts)];
        } else if ($level->isAdvanced()) {
            $advancedWorkouts = $this->getWorkoutByLevelRange(Client::ADVANCED_RANGE);

            return $advancedWorkouts[array_rand($advancedWorkouts)];
        } else if ($level->isPro()) {
            $proWorkouts = $this->getWorkoutByLevelRange(Client::PRO_RANGE);

            return $proWorkouts[array_rand($proWorkouts)];
        } else {
            $walkerWorkouts = $this->getWorkoutByLevelRange(Client::WALKER_RANGE);

            return $walkerWorkouts[array_rand($walkerWorkouts)];
        }
    }
}
