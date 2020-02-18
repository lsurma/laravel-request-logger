<?php

namespace LSurma\LaravelRequestLogger\Writers;

use Illuminate\Support\Arr;
use LSurma\LaravelRequestLogger\Models\RequestLog;

class DatabaseWriter
{
    protected $lastLogId = null;

    public function log(\Illuminate\Http\Request $request, array $options = [])
    {
        $except = [
            'password',
            'password_confirmation'
        ];

        // Cal geolocation API
        // $ipGeolocation = (serivce)->get(ip, precision = null, fresh = false) 
        // return IPGeolocationDataInterface ,

        // Log request to database
        $headers = Arr::except($request->headers->all(), ['cookie']);

        $log = new RequestLog([
            'method' => $request->getMethod(),
            'path' => $request->path(),
            'query_string' => $request->getQueryString(),
            'body' => $request->except($except),
            'referrer' => $request->header('HTTP_REFERRER', null),
            'user_agent' => $request->userAgent(),
            'headers' => $headers,
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

    protected function dictionaryValue($value, $dictionary = 'ip')
    {
        // first or create
        // return id
    }
}