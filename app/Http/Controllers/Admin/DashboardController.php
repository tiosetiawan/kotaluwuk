<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view menu', ['only' => ['index']]);
        $this->middleware('permission:create menu', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit menu', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete menu', ['only' => ['destroy']]);
        $this->middleware('permission:publish menu', ['only' => ['publish']]);
        $this->middleware('permission:unpublish menu', ['only' => ['unpublish']]);
    }

   public function index(Request $request){
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
}
