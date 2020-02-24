<?php

namespace LSurma\LaravelRequestLogger\Facades;

use Illuminate\Support\Facades\Facade;
use LSurma\LaravelRequestLogger\Interfaces\RequestLogWriterInterface;

/**
 * Request logger facade
 * 
 * @method static $this log(\Illuminate\Http\Request $request, array $options = []): bool
 * @method static $this getLastLogId()
 */
class RequestLogger extends Facade
{
    protected static function getFacadeAccessor()
    {
        return RequestLogWriterInterface::class;
    }
}