<?php

namespace App\Http\Middleware;

use App\Traits\ApiMessage;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusUser
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
        if (Auth::user()->status == "on")
            return $next($request);
        else
            return $this->returnMessage(false, 'عفوا ,هذا الحساب غير مفعل الرجاء مراجعة ادارة التطبيق  ', 200);
    }
}