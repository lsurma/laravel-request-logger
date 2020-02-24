<?php

namespace LSurma\LaravelRequestLogger;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\Repository as CacheRepository;

use LSurma\LaravelRequestLogger\Interfaces\IPGeolocationInterface;
use LSurma\LaravelRequestLogger\Interfaces\RequestLogWriterInterface;
use LSurma\LaravelRequestLogger\IPGeolocation\IPDataCo;
use LSurma\LaravelRequestLogger\Writers\DatabaseWriter;

class RequestLoggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations/');

        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations') 
        ], 'migrations');

        $this->publishes([
            __DIR__ . '/../config/request-logger.php' => config_path('request-logger.php') 
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/request-logger.php', 'request-logger');

        // Register/bind RequestLogger service
        $this->app->singleton(RequestLogWriterInterface::class, DatabaseWriter::class);

        // Register/bind IPGeolocation service
        $this->app->singleton(IPGeolocationInterface::class, function($app) {
            return new IPDataCo($app->make(CacheRepository::class), config('request-logger.ip_geolocation', []));
        });
    }
}