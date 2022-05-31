<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

   public function store(Request $request){
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return response()->json([
                'success' => true,
                'message' => $request->input('username').' login successfully !',
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => "Login failed !"
            ], 200);
        }
   }

   public function destroy(Request $request){
            
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
}
   
}
