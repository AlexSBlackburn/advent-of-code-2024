<?php

namespace App\Commands;

use App\Services\LocationService;
use App\Services\InputService;
use LaravelZero\Framework\Commands\Command;

class DayOneCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'day-one {inputFileName} {--part=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Advent of Code day 1';

    /**
     * Execute the console command.
     */
    public function handle(InputService $inputService, LocationService $locationService): int
    {
        $inputService->setFile($this->argument('inputFileName'));

        if ($this->option('part') == 1) {
            $this->info('Solution: '.$locationService->getTotalDistanceBetweenLocations());
        } else {
            $this->info('Solution: '.$locationService->getLocationSimilarityScore());
        }

        return Command::SUCCESS;
    }
}
