<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function __construct()
    {
        // $this->middleware('permission:dashboard-index', ['only' => ['index']]);
    }

   public function index(Request $request){

    // dd($this->menus($request));

    
        $data['css'] = array(
        );
        
        $data['js'] = array(
            '/js/dashboard/dashboard.js'
        );
        return view('dashboard.index',[
            'title' => 'Home',
            'data'  => $data,
        ]);
   }

   public function publish()
    {
        echo 'post berhasil dipublish';
    }

    public function unpublish()
    {
        echo 'post berhasil diunpublish';
    }

    public function menus($request){
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
        dd($array);
    }
}
