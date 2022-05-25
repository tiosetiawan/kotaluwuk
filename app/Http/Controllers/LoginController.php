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
}
