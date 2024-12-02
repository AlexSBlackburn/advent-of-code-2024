<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class InputService
{
    private string $fileName;

    public function getLocationInputs(): Collection
    {
        $left = collect();
        $right = collect();
        str($this->getFileContents())
            ->trim()
            ->explode("\n")
            ->each(function (string $line) use ($left, $right) {
                $line = str($line)->explode('   ');
                $left->push((int) $line->first());
                $right->push((int) $line->last());
            });

        return collect([
            $left->values(),
            $right->values(),
        ]);
    }

    public function getReactorReportInputs(): Collection
    {
        return str($this->getFileContents())
            ->trim()
            ->explode("\n")
            ->map(function (string $line) {
                return str($line)->explode(' ');
            });
    }

    public function setFile(string $fileName): void
    {
        $this->fileName = $fileName;
    }

    private function getFileContents(): string
    {
        return File::get(base_path('/storage/inputs/'.$this->fileName.'.txt'));
    }
}
