<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserSessionValidate
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
        if (session(config("global.session_user_obj")) == null) {
            return $next($request);
        } else {
            $redirect_value = $request->get("r");
           if($redirect_value != ""){
                return redirect($redirect_value);
           }else{
                return redirect('/');
           }     
        }

    }
}
