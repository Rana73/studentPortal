<?php

namespace App\Http\Controllers\Admin;

use App\Models\CustomField;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomFieldController extends Controller
{
    public function index(){
        $condition = [
            'institute_id' => Auth::guard('institute')->user()->id,
            'status' => 1
        ];
        $field = CustomField::where($condition)->latest()->paginate(10);
        return view('admin.customField.index', compact('field'));
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|max:50'
        ]);
       try {

           if(CustomField::where('name',$request->name)->exists()){
            return back()->with('error', 'Already Exists');
           }
           else{
            $field = new field();
            $field->name = $request->name;
            $field->user_id = Auth::user()->id;
            $field->ip_address = $request->ip();
            $field->save();
           }
           return back()->with('success', 'Successfully Inserted');
       } catch (\Throwable $th) {
        return back()->with('error', 'Inserted Failed');
       }

    }

    public function edit($id){

        $field = CustomField::find($id);
        if($field != null){
            return view('admin.field.edit', compact('field'));
        }
        else{
            return view('admin.error');
        }
    }

    public function update(Request $request, $id){

        $request->validate([
            'name' => 'required|max:50'
        ]);

       try {
           if(CustomField::where('id','!=', $id)->where('name',$request->name)->exists()){
            return back()->with('error', 'Already Exists');
           }
           else{
            $field = CustomField::find($id);
            $field->name = $request->name;
            $field->user_id = Auth::user()->id;
            $field->ip_address = $request->ip();
            $field->save();
           }
           return back()->with('success', 'Successfully Updated');
       } catch (\Throwable $th) {
        return back()->with('error', 'Updated Failed');
       }

    }

    public function destroy($id){
        try {
            if(Education::where('field_id',$id)->exists()){
                return back()->with('error', 'At First Delete Form Educational Info');
            }
            $field = CustomField::find($id);
            $field->delete();
            return back()->with('success', 'Successfully Deleted');
        } catch (\Throwable $th) {
            return back()->with('error', 'Deleted Failed');
        }
    }
}
