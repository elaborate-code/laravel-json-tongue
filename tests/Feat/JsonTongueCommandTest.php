<?php

use ElaborateCode\JsonTongue\JsonFaker\JsonFaker;
use ElaborateCode\JsonTongue\Strategies\File;

it('asks to remove old JSON files', function () {
    $jsonFaker = JsonFaker::make(true, $this->tempTestingPath, $this->baseTestingPath)
        ->addLocale('en', ['greetings.json' => ['Hi' => 'Hi']])
        ->write();

    file_put_contents(new File(config('json-tongue.lang-path')).'/old.json', json_encode([]));

    $this->artisan('json-tongue')
        ->expectsConfirmation('Do you wish to remove JSON files that already exist in the root of the lang folder?', 'no')
        ->assertFailed();

    $jsonFaker->rollback();
});

it('runs the command & translates successfully', function () {
    $jsonFaker = JsonFaker::make(true, $this->tempTestingPath, $this->baseTestingPath)
        ->addLocale('en', ['greetings.json' => ['Hi' => 'Hi']])
        ->addLocale('fr', ['greetings.json' => ['Hi' => 'Salut']])
        ->write();

    $this->artisan('json-tongue')->assertSuccessful();

    expect(__('Hi'))->toBe('Salut');

    $jsonFaker->rollback();
});

it('directly removes old JSON files when using -F option', function () {
    $jsonFaker = new JsonFaker(true, $this->tempTestingPath, $this->baseTestingPath);

    file_put_contents(new File(config('json-tongue.lang-path')).'/old.json', json_encode([]));

    $this->artisan('json-tongue -F')->assertSuccessful();

    $jsonFaker->rollback();
});
