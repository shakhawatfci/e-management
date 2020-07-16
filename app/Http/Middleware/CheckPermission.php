<?php

namespace App\Http\Middleware;
use Auth;
use DB;

use Closure;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
         $role_id = Auth::user()->role_id;
            $namedRoute         = \Route::currentRouteName();
            $current_url_check  = DB::table('menus')->select('menu_url')->where('menu_url', $namedRoute)->get()->toArray();
            if ($namedRoute)
            {
                if ($current_url_check)
                {
                    $permissionCheck = DB::table('menus')
                        ->join('permissions', 'permissions.menu_id', '=', 'menus.id')
                        ->where('role_id', $role_id)
                        ->where('menu_url', $namedRoute)
                        ->get()->toArray();
                    if (empty($permissionCheck) || count($permissionCheck) <= 0)
                    {
                        return response()->view('errors.permission_deneid', [], 404);
                    }
                }
            }

         }


        return $next($request);
    }
}
