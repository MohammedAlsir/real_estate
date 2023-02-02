<?php

namespace App\Http\Middleware;

use App\Traits\ApiMessage;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpiredMiddleware
{
    use ApiMessage;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //        28 > 29
        if (Auth::user()->subscription_end >= Carbon::now()->toDateString())
            return $next($request);
        else
            // subscription_end
            // return $this->returnMessage(false, Auth::user()->subscription_end . ' and ' . Carbon::now()->toDateString(), 200);
            return $this->returnMessage(false, 'عفوا , انتهت صلاحية حسابك الرجاء مراجعة ادارة التطبيق  ', 200);
    }
}
