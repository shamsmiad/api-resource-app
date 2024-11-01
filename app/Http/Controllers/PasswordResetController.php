<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    public function sendResetLinkEmail(Request $request){
        $validate = $request->validate([
            'email'=>'required|email|exists:user,email'
        ]);
    }
}
