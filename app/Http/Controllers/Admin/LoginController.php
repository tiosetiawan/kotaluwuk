<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Role;

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

        $role = Role::where('id', $user->role_id)->first();
        $user->assignRole($role->name);
        $user = $this->insertUser($user, $password);

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

    protected function insertUser($user, $password)
    {
        $data = [
            'name'         => $user->name,
            'username'     => $user->username,
            'password'     => bcrypt($password),
            'email'        => $user->email,
        ];
        
        $user = User::where('username', '=',  $user->username)
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
