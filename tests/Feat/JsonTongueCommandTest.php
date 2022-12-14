<?php

use ElaborateCode\JsonTongue\JsonFaker\JsonFaker;
use ElaborateCode\JsonTongue\Strategies\File;

it('asks to remove old JSON files', function () {
    $jsonFaker = JsonFaker::make(true, $this->tempTestingPath, $this->baseTestingPath)
        ->addLocale('en', ['greetings.json' => ['Hi' => 'Hi']])
        ->write();

    file_put_contents(new File(config('json-tongue.lang-path')).'/old.json', json_encode([]));

    $this->artisan('json-tongue:merge')
        ->expectsConfirmation('Do you wish to remove JSON files that already exist in the root of the lang folder?', 'no')
        ->assertFailed();

    $jsonFaker->rollback();
});

it('runs the command & translates successfully', function () {
    $jsonFaker = JsonFaker::make(true, $this->tempTestingPath, $this->baseTestingPath)
        ->addLocale('fr', [
            'greetings.json' => ['Hi' => 'Salut'],
            'jobs.json' => ['Programmer' => 'Programeur'],
            'animals.json' => ['Cat' => 'Chat'],
        ])
        ->addLocale('es', [
            'greetings.json' => ['Hi' => 'Hola'],
            'jobs.json' => ['Programmer' => 'Programmador'],
            'animals.json' => ['Cat' => 'Gato'],
        ])
        ->write();

    $this->artisan('json-tongue:merge')->assertSuccessful();

    expect(__('Hi'))->toBe('Salut');

    $jsonFaker->rollback();
});

it('directly removes old JSON files when using -F option', function () {
    $jsonFaker = new JsonFaker(true, $this->tempTestingPath, $this->baseTestingPath);

    file_put_contents(new File(config('json-tongue.lang-path')).'/old.json', json_encode([]));

    $this->artisan('json-tongue:merge -F')->assertSuccessful();

    $jsonFaker->rollback();
});
