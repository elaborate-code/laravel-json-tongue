<?php

it('runs the command', function () {
    $this->artisan('json-tongue')->assertExitCode(0);
});
