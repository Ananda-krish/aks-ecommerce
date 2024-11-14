<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view("admin.login");  // Ensure this view exists
    }
    public function dologin(){
    $input = request()->only(['username','password']);
    if(Auth()->guard('admin')->attempt($input,request('remember_me'))){
        return redirect()->route('admin.dashboard');
    }else{
        return view('admin.login')->with('message','login failed');
    }
    }
    public function dashboard(){
        return view('admin.dashboard');
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
    public function userinfo(){
        $userinfos = User::latest()->paginate(10);
        return view('admin.userinfo',compact('userinfos'));
    }
    public function edit($id){
        $useredits= User::find(decrypt($id));
        return view('admin.useredit',compact('useredits'));
    }

    public function update(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->id, // Exclude current user's email from unique validation
        ]);

        // Find the user by ID
        $user = User::findOrFail($request->id);

        // Update the user's data
        $user->name = $request->name;
        $user->email = $request->email;

        // Save the changes
        $user->save();

        // Redirect back to user info page with a success message
        return redirect()->route('admin.userinfo')->with('message', 'Update successful!');
    }
    public function delete($id){
        $user= User::find( decrypt($id));
        $user->delete();
        return view('admin.userinfo')->with('message',' successfully deleted');
    }
    public function orderinfo(){
        $payments= Payment::latest()->paginate(10);
        return view('admin.orderinfo',compact('payments'));
    }

}
