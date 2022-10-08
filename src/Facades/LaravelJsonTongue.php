<?php

namespace ElaborateCode\LaravelJsonTongue\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ElaborateCode\LaravelJsonTongue\LaravelJsonTongue
 */
class JsonTongue extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \ElaborateCode\LaravelJsonTongue\LaravelJsonTongue::class;
    }
}
