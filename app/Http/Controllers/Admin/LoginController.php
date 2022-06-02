<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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

        //login cherry check
        $response = Http::post(config('app.cherry_service_token'), [
            'CommandName' => 'RequestToken',
            'ModelCode' => 'AppUserAccount',
            'UserName' => $request->input('username'),
            'Password' => $request->input('password'),
            'ParameterData' => [],
        ]);

        if (!$response['Token']) {
            return response()->json([
                'success' => false,
                'message' => $response['Message'],
            ], 401);
        } 

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
            ], 401);
        }
   }

   public function destroy(Request $request){
            
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
}
   
}
