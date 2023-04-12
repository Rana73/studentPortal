<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use App\Models\CustomField;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\FieldResource;
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
        dd($request->all());
        $request->validate([
            'class' => 'required|max:100',
            'name' => 'required|max:100',
            'email' => 'email:rfc,dns|required|max:100|unique:students',
            'phone' => 'required|max:11|min:11|unique:students'
        ]);

        $custom_fields = $request->except(['name', 'email', 'phone', 'class']);
        dd($custom_fields);
        try {
            DB::beginTransaction();

            DB::commit();
            return back()->with('success', 'Successfully Inserted');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Inserted Failed');
        }

    }
}
