<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller{
    public function developerlook_index(){
        if(session()->has('username')){
            return redirect()->route('uploadFile');
        }
        elseif(session()->has('basicUser')){
            return redirect()->route('timeline');
        }
        return view('home');
        
    }
    // public function developerlook_login(Request $request){
    //     $username = $request->input('username');
    //     $password = $request->input('password');
    //     $data = DB::table('users')->where('username', $username)->where('password', $password)->get();
    //     if(count($data)){
    //         $request->session()->put('username', $username);
    //         return redirect()->route('uploadFile');
    //     }else{
    //         return redirect()->route('home');
    //     }
    // }
    public function developerlook_login(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');
        $data = DB::table('users')->where('username', $username)->where('password', $password)->where('is_admin',true)->get();
        if(count($data)){
            $request->session()->put('username', $username);
            return redirect()->route('uploadFile');
        }else{
            $data = DB::table('users')->where('username', $username)->where('is_admin',false)->first();
            if($data){
                $password = Hash::check($password, $data->password);
                $remember_token = $data->remember_token;
                if($remember_token == null){
                    if($data && $password){
                        $request->session()->put('basicUser', $data->username);
                        return redirect()->route('timeline')->with('success', 'Login Successfully');
                    }
                    else{
                        return redirect()->route('home')->with('error', 'Invalid Username or Password');
                    }
                }
                else{
                    return redirect()->route('userVerify')->with('error', 'Please Verify Your Email First');
                }
            }
            else{
                return redirect()->route('home')->with('error', 'Invalid Username or Password');
            }
        }
    }
    public function developerlook_logout(Request $request){
        // dd($request->session()->all());
        if ($request->session()->has('username')) {
            $request->session()->forget('username');
        } elseif ($request->session()->has('basicUser')) {
            $request->session()->forget('basicUser');
        }        
        return redirect()->route('home');
    }
}