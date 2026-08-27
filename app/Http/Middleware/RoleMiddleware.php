<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {

        if (!auth()->check()) {
            return redirect('/login');
        }


       if (auth()->user()->role !== $role) {

    dd([
        'user'=>auth()->user()->username,
        'role_user'=>auth()->user()->role,
        'role_required'=>$role,
        'url'=>$request->url()
    ]);

}


        return $next($request);
    }
}