<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Str;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            $uri = $request->path();
            if(Str::startsWith($uri, ['administer/'])) {
                return 'administer';
            }else if(Str::startsWith($uri, ['member/'])){
                return 'member';
            }
            var_dump("else");
        }
    }
}
