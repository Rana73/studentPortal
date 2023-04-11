<?php

namespace App\Http\Controllers\Admin;

use App\Models\Institute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class InstituteController extends Controller
{
    public function edit()
    {
        $user = Institute::find(Auth::guard('institute')->user()->id);
        return view('auth.edit', compact('user'));
    }

    public function updateUser(Request $request)
    {
       
        $request->validate([
            'name' => 'required|max:50',
            // 'username' =>'required',
            'email' => 'required|max:30',
            'image' => 'image|mimes:jpg,png,gif,bmp',
            // 'password'=>'confirmed|min:6',
            'ip_address' => 'max:15'
        ]);

        try {
            $user = Institute::where('id',Auth::guard('institute')->user()->id)->first();
            $userImage = '';
            if ($request->hasFile('image')) {
                if (!empty($user->image) && file_exists($user->image)) {
                    unlink($user->image);
                }
                $userImage = $this->imageUpload($request, 'image', 'uploads/user');
            } else {
                $userImage = $user->image;
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->image = $userImage;
            $user->status = 1;
            $user->save();
            Session::flash('success', ' User update Successfully');
            return back();
        } catch (\Throwable $th) {
            
            Session::flash('errors', ' something went wrong');
            return back();

        }

    }

    public function passwordChange(){
       return view('auth.password_change');
    }

    public function passwordUpdate(Request $request){

        $request->validate([
            'currentPass' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        try {
            $currentPassword = Auth::guard('institute')->user()->password;
            if (Hash::check($request->currentPass, $currentPassword)) {
                if (!Hash::check($request->password, $currentPassword)) {
                    $user = Auth::guard('institute')->user();
                    $user->password = Hash::make($request->password);
                    $user->save();
                    if ($user) {
                        Session::flash('success', 'Password Update Successfully');

                        return back();
                    } else {
                        Session::flash('error', 'Current password not match');
                        return back();
                    }
                } else {
                    Session::flash('error', 'Same as Current password');
                    return back();
                }
            } else {
                Session::flash('error', '!Current password not match');
                return back();
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
            Session::flash('error', 'Something went wrong');
            return back();
        }
    }
}
