<?php

namespace App\Http\Middleware;

use App\Models\MainCategory;
use Closure;
use Illuminate\Http\Request;

class MainCategoryMiddleware
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
        view()->share([
            'main_categories' => MainCategory::orderBy('id','desc')->get()
        ]);

        return $next($request);
    }
}
