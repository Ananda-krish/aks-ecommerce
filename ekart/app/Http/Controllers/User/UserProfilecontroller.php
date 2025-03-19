<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfilecontroller extends Controller
{
    public function showprofile()
    {
        $user = Auth::user();
        $payments = Payment::where('user_id', $user->id)->get();

        return view('users.template.profile',  compact('user', 'payments'));
    }
}
