<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

 
function menus(){
    $array = array();
    $permissions = Auth::user()
    ->getAllPermissions();
    foreach ($permissions as $permission) {
        if(Str::contains($permission->name, 'index')) {
            $array[] = [
                'menu' => $permission->menu_name,
                'icon' => $permission->icon,
                'route_name' => $permission->route_name
            ];
        }
    }
    return $array;
}