<?php

namespace App\Http\Middleware;

use Closure;

class NormalizeRequestParameters
{
    public function handle($request, Closure $next)
    {
        $input = $request->all();
        $input = $this->convertNullsToEmptyStrings($input);
        $request->merge($input);
        return $next($request);
    }

    private function convertNullsToEmptyStrings($input)
    {
        foreach ($input as $key => $value) {
            if (is_array($value)) {
                $input[$key] = $this->convertNullsToEmptyStrings($value);
            } elseif ($value === null) {
                $input[$key] = '';
            }
        }
        return $input;
    }
}
