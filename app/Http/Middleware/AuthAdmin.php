<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class AuthAdmin
{
    /**
     * The auth instance.
     *
     * @var Illuminate\Contracts\Auth\Guard
     */
    protected $auth;
    
    /**
     * Create a new auth instance.
     *
     * @param Illuminate\Contracts\Auth\Guard $auth Auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request request
     * @param \Closure                 $next    next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('/login');
            }
        } elseif (! $request->user()->hasRole('admin')) {
            return redirect('/home');
        }
        return $next($request);
    }
}
