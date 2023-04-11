<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ContactUsController extends Controller
{
    public function index(){
        $contact = ContactUs::first();
        return view('admin.contact.index',compact('contact'));
    }
    public function update(Request $request){

        try {
            $contact = ContactUs::first();
            $contact->slogan = $request->slogan;
            $contact->phone = $request->phone;
            $contact->email = $request->email;
            $contact->name = $request->name;
            $contact->address = $request->address;
            $contact->facebook = $request->facebook;
            $contact->twitter = $request->twitter;
            $contact->linkedin = $request->linkedin;
            $contact->youtube = $request->youtube;
            $contact->instagram = $request->instagram;
            $contact->map = $request->map;

            $mainImagewithPath = $contact->image;
                if($request->hasFile('image')){
                    if (!empty($contact->image) && file_exists($contact->image)) {
                        unlink($contact->image);
                    }
                    $image = $request->file('image');
                    $mainImage = 'c-' . time() . uniqid() . $image->getClientOriginalName();
                    $thumbImage = 'thumb-' . time() . uniqid() . $image->getClientOriginalName();
                    Image::make($image)->save('uploads/contact/' . $mainImage);
                    $mainImagewithPath = 'uploads/contact/'.$mainImage;
                }
            $contact->image = $mainImagewithPath;
            $contact->save();
            return back()->with('success','Contact Us Updated Successfully');
        } catch (\Throwable $th) {
            return back()->with('error','Contact Us Updated Failed');
        }


    }
}
