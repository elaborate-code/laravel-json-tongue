<?php

use ElaborateCode\JsonTongue\JsonFaker\JsonFaker;
use ElaborateCode\JsonTongue\TongueFacade;

it('uses php-json-tongue', function () {
    $jsonFaker = JsonFaker::make(tempTestingPath: '/lang', base_testing_path: '/tests/FakeLaravel')
        ->addLocale('en', ['greetings.json' => ['Hi' => 'Hi']])
        ->addLocale('fr', ['greetings.json' => ['Hi' => 'Salut']])
        ->write();

    $localizaion = new TongueFacade('/tests/FakeLaravel/lang');

    expect($localizaion)
        ->transcribe()->toHaveCount(2)
        ->transcribe()->toHaveKey('en')
        ->transcribeLang('en')->toHaveCount(1)
        ->transcribeLang('en')->toHaveKey('Hi')->toContain('Hi')
        ->transcribe()->toHaveKey('fr')
        ->transcribeLang('fr')->toHaveCount(1)
        ->transcribeLang('fr')->toHaveKey('Hi')->toContain('Salut');

    $jsonFaker->rollback();
});
