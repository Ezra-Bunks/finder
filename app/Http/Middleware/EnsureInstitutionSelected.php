<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureInstitutionSelected
{
    public function handle(Request $request, Closure $next): Response
    {
        $hasInstitution = session('institution_id')
            || (auth()->check() && auth()->user()->institution_id);

        if (!$hasInstitution && !$request->routeIs('institution.*')) {
            return redirect()->route('institution.select');
        }

        return $next($request);
    }
}