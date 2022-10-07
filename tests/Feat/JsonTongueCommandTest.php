<?php

use ElaborateCode\JsonTongue\JsonFaker\JsonFaker;

it('runs the command', function () {
    $jsonFaker = JsonFaker::make(true, $this->tempTestingPath, $this->baseTestingPath)
        ->addLocale('en', ['greetings.json' => ['Hi' => 'Hi']])
        ->addLocale('fr', ['greetings.json' => ['Hi' => 'Salut']])
        ->write();

    $this->artisan('json-tongue')->assertExitCode(0);

    expect(__('Hi'))->toBe('Salut');

    $jsonFaker->rollback();
});
