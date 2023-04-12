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
            'title' => 'required|max:100',
            'type' => 'required'
        ]);
       try {

            $exist_condition = [
                'title' => $request->title,
                'type'  => $request->type,
                'institute_id' => Auth::guard('institute')->user()->id
            ];
           if(CustomField::where($exist_condition)->exists()){
            return back()->with('error', 'Already Exists');
           }
           else{
            $field = new CustomField();
            $field->institute_id = Auth::guard('institute')->user()->id;
            $field->title = $request->title;
            $field->type = $request->type;
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
            return view('admin.customField.edit', compact('field'));
        }
        else{
            return view('admin.error');
        }
    }

    public function update(Request $request, $id){

        $request->validate([
            'title' => 'required|max:100',
            'type' => 'required'
        ]);

       try {
            $exist_condition = [
                'title' => $request->title,
                'type'  => $request->type,
                'institute_id' => Auth::guard('institute')->user()->id
            ];
           if(CustomField::where('id','!=', $id)->where($exist_condition)->exists()){
            return back()->with('error', 'Already Exists');
           }
           else{
            $field = CustomField::find($id);
            $field->title = $request->title;
            $field->type = $request->type;
            $field->save();
           }
           return back()->with('success', 'Successfully Updated');
       } catch (\Throwable $th) {
        return back()->with('error', 'Updated Failed');
       }

    }

    public function destroy($id){
        try {
            $field = CustomField::find($id);
            $field->delete();
            return back()->with('success', 'Successfully Deleted');
        } catch (\Throwable $th) {
            return back()->with('error', 'Deleted Failed');
        }
    }
}
