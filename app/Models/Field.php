<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Field extends Model
{
    use HasFactory;

    protected $fillable = ['student_id','title', 'type', 'value'];
    
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
