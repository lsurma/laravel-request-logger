<?php

namespace LSurma\LaravelRequestLogger;

class DefaultLogWriter
{
    public function log(\Illuminate\Http\Request $request)
    {
        dd($uri = $request->getPathInfo());
    }
}