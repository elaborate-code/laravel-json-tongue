<?php

namespace ElaborateCode\LaravelJsonTongue\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ElaborateCode\LaravelJsonTongue\JsonTongue
 */
class JsonTongue extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \ElaborateCode\LaravelJsonTongue\JsonTongue::class;
    }
}
