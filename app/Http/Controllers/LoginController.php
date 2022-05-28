<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
   public function index(){
       
        $data['css'] = array(
            '/css/portal.css',  
        );
        
        $data['js'] = array(
            '/js/login/login.js'
        );

        return view('login.index',[
            'title' => 'LOGIN',
            'data'  => $data
        ]);
   }

   public function tostr(Request $request){
    $request->validate([
        'username' => 'required|email:dns',
        'password' => 'required',
    ]);

    if($request->input('username')){
        return response()->json([
            'success' => true,
            'message' => $request->input('username')
        ], 200);
    }else{
        return response()->json([
            'success' => false,
            'message' => "Gagal Login"
        ], 200);
    }
   }
}
