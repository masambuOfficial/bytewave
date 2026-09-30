<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureModuleAccess
{
    public function handle(Request $request, Closure $next, string $module)
    {
        $user = $request->user();

        if ($user && $user->canAccess($module)) {
            return $next($request);
        }

        return redirect()->route('admin.dashboard')
            ->with('error', 'Your role does not have access to that section.');
    }
}
