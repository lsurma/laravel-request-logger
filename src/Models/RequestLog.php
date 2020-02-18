<?php

namespace LSurma\LaravelRequestLogger\Models;

use Illuminate\Database\Eloquent\Model;

class RequestLog extends Model
{
    // updated_at column will be not used
    const UPDATED_AT = null;

    protected $fillable = [
        'method',
        'path',
        'query_string',
        'body',
        'referrer',
        'user_agent',
        'headers',
        'ip',
        'country_code',
        'region',
        'city',
        'latitude',
        'longitude',
        'user_type',
        'user_id',
        'custom_attributes'
    ];

    protected $casts = [
        'body' => 'array',
        'headers' => 'array',
        'latitude' => 'decimal:11',
        'longitude' => 'decimal:11',
        'custom_attributes' => 'array'
    ];
}
