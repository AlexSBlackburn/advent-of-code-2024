<?php

it('solves day 1 part 1', function () {
    $this->artisan('day-one tests/day1 --part=1')
        ->expectsOutput('Solution: 11')
        ->assertSuccessful();
});

it('solves day 1 part 2', function () {
    $this->artisan('day-one tests/day1 --part=2')
        ->expectsOutput('Solution: 31')
        ->assertSuccessful();
});
