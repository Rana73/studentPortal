<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\Field;
use App\Models\Student;
use App\Models\CustomField;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\StudentResource;

class StudentController extends Controller
{
    public function index()
    {
        $condition = [
            'institute_id' => Auth::guard('institute')->user()->id,      
        ];
        $student = Student::where($condition)->latest()->get();
        $data = collect(StudentResource::collection($student))->toArray();
        $field = CustomField::select('title','type')->where($condition)->where('status',1)->get();
        return view('admin.student.index',compact('data','field'));
    }

    public function store(Request $request){
     
        $request->validate([
            'class' => 'required|max:100',
            'name' => 'required|max:100',
            'email' => 'email:rfc,dns|required|max:100|unique:students',
            'phone' => 'required|max:11|min:11|unique:students'
        ]);

        try {
            DB::beginTransaction();
            $student = new Student();
            $student->institute_id = Auth::guard('institute')->user()->id;
            $student->name = $request->name;
            $student->class = $request->class;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->save();           
            $custom_fields = $request->except(['name', 'email', 'phone', 'class','_token']);
            foreach($custom_fields as $key=>$item){
                if($item != null){
                    $field = new Field();
                    $field->student_id = $student->id;
                    $field->title = str_replace("_", " ", $key);
                    $field->value = $item;
                    $field->save();
                }            
            }
            DB::commit();
            return back()->with('success', 'Successfully Inserted');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Inserted Failed');
        }

    }

    public function destroy($id){
        Student::find($id)->delete();
        return back()->with('success', 'Successfully Deleted'); 
    }
}

