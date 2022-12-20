<?php

namespace App\Http\Middleware;

use App\Models\Frontdesk;
use Closure;
use Illuminate\Http\Request;

class HasFrontdesk
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $activeFrontdesk = Frontdesk::whereBranchId(auth()->user()->branch_id)
            ->whereActive(true)
            ->count();

        if (! $activeFrontdesk) {
            return redirect()->route('frontdesk.shifting');
        }

        return $next($request);
    }
}
