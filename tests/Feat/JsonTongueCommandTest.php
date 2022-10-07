<?php

it('does', function () {
    $this->artisan('json-tongue')->assertExitCode(0);
});

it('translate', function () {
    $this->app->useLangPath(__DIR__ . '/../lang');

    // dump($this->app->getLocale());

    dump(trans('hey', locale: 'en'));

    expect(__('hey'))->toBe('yo');
});
