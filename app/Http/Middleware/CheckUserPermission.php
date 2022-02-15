<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Traits\UserTrait;

class CheckUserPermission
{
    use UserTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$perid)
    {

        if(session(config("global.session_permissions")) !== null){
            $user_all_permissions=json_decode(session(config("global.session_permissions")));
            if($this->user_role_isPermissionAvilable($user_all_permissions,$perid)){
                    return $next($request);     
            }
        }

        if($request->ajax()){
            return response()->json("Permission denied",401);
        } 
        return abort(401);
    }
}
