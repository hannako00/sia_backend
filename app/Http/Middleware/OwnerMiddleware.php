<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $car = $request->route('car');

        if($car==null) {
            return response()->json(['message'=>'The car cannot be found'], 404);
        }

        if($car->user_id != auth()->user()->id) {
            return response()->json(['message'=>'You are not the owner of this car.'], 401);
        }

        return $next($request);
    }
}
