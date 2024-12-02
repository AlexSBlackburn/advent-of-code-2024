<?php

namespace App\Commands;

use App\Services\InputService;
use App\Services\ReactorService;
use LaravelZero\Framework\Commands\Command;

class DayTwoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'day-two {inputFileName} {--part=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Advent of Code day 2';

    /**
     * Execute the console command.
     */
    public function handle(InputService $inputService, ReactorService $reactorService): int
    {
        $inputService->setFile($this->argument('inputFileName'));

        if ($this->option('part') == 1) {
            $this->info('Solution: '.$reactorService->getTotalSafeReports());
        } else {
            $this->info('Solution: '.$reactorService->getTotalSafeReportsWithDampener());
        }

        return Command::SUCCESS;
    }
}
