<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Resources\FieldResource;
use App\Http\Resources\StudentResource;

class StudentController extends Controller
{
    public function showStudent($id)
    {
        $student = Student::find($id);
        $fields = $student->fields;
        
        return response()->json([
            'student' => new StudentResource($student),
            'fields' => FieldResource::collection($fields),
        ]);
    }
}
