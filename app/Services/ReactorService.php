<?php

namespace App\Services;

use Illuminate\Support\Collection;

class ReactorService
{
    public function __construct(private InputService $inputService) {}

    public function getTotalSafeReports(): int
    {
        $reports = $this->inputService->getReactorReportInputs();

        // Reports should increase or decrease in value
        $reports = $reports
            ->filter(function (Collection $report) {
                return $report->every(function (int $value, int $key) use ($report) {
                    if ($key === 0) {
                        return true;
                    }

                    // Ascending
                    if ($report->first() < $report->last()) {
                        return $value > $report[$key - 1];
                    }

                    // Descending
                    return $value < $report[$key - 1];
                });
            });

        // Reports should not have a difference greater than 3
        $reports = $reports->filter(function (Collection $report) {
            return $report->every(function (int $value, int $key) use ($report) {
                if ($key === 0) {
                    return true;
                }

                // Ascending
                if ($report->first() < $report->last()) {
                    return ($value - $report[$key - 1]) < 4;
                }

                // Descending
                return ($report[$key - 1] - $value) < 4;
            });
        });

        return $reports->count();
    }

    public function getTotalSafeReportsWithDampener(): int
    {
        $reports = $this->inputService->getReactorReportInputs();

        // Reports should increase or decrease in value
        $reports = $reports
            ->filter(function (Collection $report) {
                return $report->every(function (int $value, int $key) use ($report) {
                    if ($key === 0) {
                        return true;
                    }

                    // Ascending
                    if ($report->first() < $report->last()) {
                        return $value > $report[$key - 1];
                    }

                    // Descending
                    return $value < $report[$key - 1];
                });
            });

        // Reports should not have a difference greater than 3
        $reports = $reports->filter(function (Collection $report) {
            $badReports = 0;

            return $report->every(function (int $value, int $key) use ($report, $badReports) {
                if ($key === 0) {
                    return true;
                }

                // Ascending
                if ($report->first() < $report->last()) {
                    $safe = ($value - $report[$key - 1]) < 4;
                } else {
                    $safe = ($report[$key - 1] - $value) < 4;
                }

                if (!$safe) {
                    $badReports++;
                }

                if ($badReports < 2) {
                    return true;
                }

                return false;
            });
        });

        return $reports->count();
    }
}
