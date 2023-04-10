<?php

namespace App\Models;

use App\Models\Field;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    
    protected $fillable = ['class', 'name', 'email', 'phone', 'status'];

    public function fields()
    {
        return $this->hasMany(Field::class);
    }
}

