<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use App\UserRole;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller {

    public function loginView(){
        return view('auth.login');
    }
    public function login(LoginRequest $request){
        $credentials = $request->only('email', 'password');
        $bannedUser = User::where("email", $credentials['email'])->first();
        if($bannedUser && $bannedUser->banned) return back()->withErrors(['server' => "Banned from platform"]);   
        if(!Auth::attempt($credentials)) return back()->withErrors(['server' => "wrong credentials"]);
        $request->session()->regenerate();
        return redirect()->intended('/colocations');
    }
    public function registerView(){
        return view('auth.register');
    }
    
    public function register(RegisterRequest $request){
        $data = $request->only('email', 'password', 'username');
        if($request->hasFile('image')) $data['image'] = $request->file('image')->store('uploads/avatars', 'public');
        $role = User::count() > 0 ? Role::where('name', UserRole::Member->value)->first() : Role::where('name', UserRole::Admin->value)->first(); 
        $data['role_id'] = $role->id;
        $user = (new User())->fill($data);
        $user->save();
        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->intended('/');   
    }
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
