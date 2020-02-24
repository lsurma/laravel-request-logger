<?php

namespace LSurma\LaravelRequestLogger\Facades;

use Illuminate\Support\Facades\Facade;
use LSurma\LaravelRequestLogger\Interfaces\IPGeolocationInterface;

class IPGeolocation extends Facade
{
    protected static function getFacadeAccessor()
    {
        return IPGeolocationInterface::class;
    }
}