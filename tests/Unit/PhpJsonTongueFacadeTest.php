<?php

use ElaborateCode\JsonTongue\JsonFaker\JsonFaker;
use ElaborateCode\JsonTongue\TongueFacade;

it('uses php-json-tongue', function () {
    $jsonFaker = JsonFaker::make(true, $this->tempTestingPath, $this->baseTestingPath)
        ->addLocale('en', ['greetings.json' => ['Hi' => 'Hi']])
        ->addLocale('fr', ['greetings.json' => ['Hi' => 'Salut']])
        ->write();

    $localization = new TongueFacade(config('json-tongue.lang-path'));

    expect($localization)
        ->transcribe()->toHaveCount(2)
        ->transcribe()->toHaveKey('en')
        ->transcribeLang('en')->toHaveCount(1)
        ->transcribeLang('en')->toHaveKey('Hi')->toContain('Hi')
        ->transcribe()->toHaveKey('fr')
        ->transcribeLang('fr')->toHaveCount(1)
        ->transcribeLang('fr')->toHaveKey('Hi')->toContain('Salut');

    $jsonFaker->rollback();
});
