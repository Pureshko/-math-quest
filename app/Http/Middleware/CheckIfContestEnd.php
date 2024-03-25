<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Settings;

class CheckIfContestEnd
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $contest_end = Settings::where('key', 'contest_end')->first();
        if($contest_end && strtotime($contest_end->value) < time()){
            return redirect()->route('main-page')->with('error', 'Contest has ended');
        }
        return $next($request);
    }
}
