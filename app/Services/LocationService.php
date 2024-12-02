<?php

namespace App\Services;

class LocationService
{
    public function __construct(
        private InputService $inputService
    )
    {
    }

    public function getTotalDistanceBetweenLocations(): int
    {
        $inputs = $this->inputService->getInputs();

        $left = $inputs->first()->sort()->values();
        $right = $inputs->last()->sort()->values();

        $differences = $right->map(function ($value, $key) use ($left) {
            if ($value > $left[$key]) {
                return $value - $left[$key];
            }

            return $left[$key] - $value;
        });

        return $differences->sum();
    }

    public function getLocationSimilarityScore(): int
    {
        $inputs = $this->inputService->getInputs();
        $left = $inputs->first()->sort()->values();
        $right = $inputs->last()->sort()->values()->countBy(); // 1 => 3, 2 => 2, 3 => 1, etc

        $similarities = $left->map(function ($value) use ($right) {
            if ($right->has($value)) {
                return $value * $right[$value];
            }

            return 0;
        });

        return $similarities->sum();
    }
}
