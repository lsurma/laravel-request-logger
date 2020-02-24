<?php

namespace LSurma\LaravelRequestLogger\Interfaces;

interface RequestLogWriterInterface
{
    public function log(\Illuminate\Http\Request $request, array $options = []): bool;
    
    public function getLastLogId();
}