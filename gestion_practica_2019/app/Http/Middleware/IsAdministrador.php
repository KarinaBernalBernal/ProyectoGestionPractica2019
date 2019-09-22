<?php

namespace SGPP\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;
use Closure;

class IsAdministrador
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        if ($this->auth->user()->type != 'administrador')
            // ($user = Auth::user()) instanceOf User && $user->is_admin)
        {
            $this->auth->logout();
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->to('auth/login');
            }
        }

        return $next($request);
    }
}
