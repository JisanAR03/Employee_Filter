<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify($service,$token)
    {   
        if($service == 'user'){
        $user = User::where('remember_token', 'user/'.$token)->first();
        if ($user) {
            $user->remember_token = null;
            $user->save();
            return redirect()->route('home')->with('success', 'Email verified successfully.');
        }
        else{
            return redirect()->route('home')->with('error', 'User not found.');
        }
        }
    }
}
