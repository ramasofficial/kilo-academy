<?php

declare(strict_types=1);

namespace Kilo\Solid\Repositories;

use RuntimeException;

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
        return Workout::whereBetween('level', $level)->pluck('id')->toArray();
    }

    private function hasWorkout(Workout $workout): bool
    {
        if (!$workout) {
            return false;
        }

        return true;
    }
}
