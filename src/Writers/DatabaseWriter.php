<?php

namespace LSurma\LaravelRequestLogger\Writers;

use Illuminate\Support\Arr;
use LSurma\LaravelRequestLogger\Interfaces\RequestLogWriterInterface;
use LSurma\LaravelRequestLogger\Models\RequestLog;

class DatabaseWriter implements RequestLogWriterInterface
{
    protected $lastLogId = null;

    public function log(\Illuminate\Http\Request $request, array $options = []): bool
    {
        $bodyExcept = $options['request_body_except'] ?? config('request-logger.request_body_except', null) ?? [
            'password',
            'password_confirmation'
        ];

        $headersExcept = $options['request_headers_except'] ?? config('request-logger.request_headers_except', null) ?? [
            'cookie',
        ];


        // Cal geolocation API
        // $ipGeolocation = (serivce)->get(ip, precision = null, fresh = false) 
        // return IPGeolocationDataInterface ,

        // Log request to database
        $log = new RequestLog([
            'method' => $request->getMethod(),
            'path' => $request->path(),
            'query_string' => $request->getQueryString(),
            'body' => $request->except($bodyExcept),
            'referrer' => $request->header('HTTP_REFERRER', null),
            'user_agent' => $request->userAgent(),
            'headers' => Arr::except($request->headers->all(), $headersExcept),
            'ip' => $request->ip(),
            'country_code' => null,
            'region' => null,
            'city' => null,
            'latitude' => null,
            'longitude' => null,
            'user_type' => null,
            'user_id' => null,
            'custom_attributes' => null
        ]);
        
        $save = $log->save();

        // Save last id
        $this->lastLogId = $log->id;

        // Return status
        return $save;
    }

    public function getLastLogId()
    {
        return $this->lastLogId;
    }
}