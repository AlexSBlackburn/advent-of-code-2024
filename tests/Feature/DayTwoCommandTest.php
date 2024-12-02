<?php

it('solves day 2 part 1', function () {
    $this->artisan('day-two tests/day2 --part=1')
        ->expectsOutput('Solution: 2')
        ->assertSuccessful();
});

it('solves day 2 part 2', function () {
    $this->artisan('day-two tests/day2 --part=2')
        ->expectsOutput('Solution: 4')
        ->assertSuccessful();
});
