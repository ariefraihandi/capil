<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\AccessMenu;
use App\Models\AccessSub;
use App\Models\AccessSubChild;
use App\Models\MenuSub;
use App\Models\MenuSubChild;

class SidebarMiddleware
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
         if ($request->session()->has('role')) {
             $role = $request->session()->get('role');
             $request->merge(['userRole' => $role]);
             
             $accessMenus = AccessMenu::where('role_id', $role)
             ->with(['menu', 'accessSubs.accessSubChildren'])
             ->get();             
     
             $request->attributes->set('accessMenus', $accessMenus);
     
             $currentRouteName = $request->route()->getName();
     
             $childMenuSub = MenuSubChild::where('url', $currentRouteName)->first();
     
             // Jika child submenu ditemukan
             if ($childMenuSub) {
                // Cari akses langsung ke child submenu untuk role pengguna yang login
                $accessSubChild = AccessSubChild::where('role_id', $role)
                    ->where('childsubmenu_id', $childMenuSub->id)
                    ->first();
    
                // Jika akses ditemukan, biarkan permintaan dilanjutkan
                if ($accessSubChild) {
                    $request->attributes->set('authorized', true);
                    return $next($request);
                }
            } else {
                 $menuSub = MenuSub::where('url', $currentRouteName)->first();
    //  dd($currentRouteName);
                 $accessSub = AccessSub::where('role_id', $role)
                                ->where('submenu_id', $menuSub->id)
                                ->first();

                if ($accessSub) {
                    $request->attributes->set('authorized', true);
                    return $next($request);
                }
             }
         } else {
             return redirect()->route('login.view');
         }
     
         $response = [
            'success' => false,
            'title' => 'Not Authorized',
            'message' => 'Anda tidak memiliki akses ke halaman Ini',
        ];

         return redirect()->route('user.account.detil')->with('response', $response);
     }
    
    
}
