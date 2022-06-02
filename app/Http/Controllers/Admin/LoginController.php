<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
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

        $username = $request->input('username');
        $password = $request->input('password');
        $user = User::where('username', $username)->first();

        if(!$user){
            return response()->json([
                'success' => false,
                'message' => 'Username is not registered !',
            ], 401);
        }

        //login cherry check
        $response = Http::post(config('app.token_cherry'), [
            'CommandName' => 'RequestToken',
            'ModelCode' => 'AppUserAccount',
            'UserName' => $username,
            'Password' => $password,
            'ParameterData' => [],
        ]);

        if (isset($response['Token'])) {
            $user = $this->insertUser($response, $password);
        }else{
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

    protected function insertUser($response, $password)
    {
        $data = [
            'name'         => $response['Data']['Name'],
            'token_cherry' => $response['Token'],
            'username'     => $response['UserName'],
            'password'     => bcrypt($password),
            'perusahaan'   => $response['Data']['Company'],
            'divisi'       => $response['Data']['Organization'],
            'email'        => $response['Data']['Email'],
        ];
        
        $user = User::where('username', '=', $response['UserName'])
        ->update($data);
        return $user;
    }

   public function destroy(Request $request){
            
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
   
}
