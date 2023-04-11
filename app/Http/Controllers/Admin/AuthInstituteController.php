<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthInstituteController extends Controller
{
    public function loginShow()
    {
    
      if (Auth::guard('institute')->check()) {
        return redirect()->route('dashboard');
      } else {
        return view('auth.login');
      }
    }
  
    public function dashboard(){
      if (Auth::guard('institute')->check()) {
        return view('admin.index');
      } else {
        return view('auth.login');
      }
    }
  
    public function authCheck(Request $request)
    {
    //   dd($request->all());
      $request->validate([
        'username' => 'required|min:6',
        'password' => 'required|min:6'
      ]);
  
      try {
            $credential = $request->only('username', 'password');
            // return Auth::guard('institute')->attempt($credential);
            if(Auth::guard('institute')->attempt($credential)){
              return redirect()->route('dashboard');
            }
            else{
                return redirect()->back()->with('error', 'Username or Password Incorrect !');
            }    
          } catch (\Throwable $th) {
              return redirect()->back()->with('error', 'Username or Password Incorrect !'. $th->getMessage());
          }
    }
  
    public function logout()
    {
      Auth::guard('institute')->logout();
      return redirect()->route('login');
    }
}
