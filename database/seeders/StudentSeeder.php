<?php

namespace Database\Seeders;

use App\Models\Field;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //Student Demo Data
         $jsonString = File::get(storage_path('data/student/student_demo_data.json'));

         $data = json_decode($jsonString, true);
         foreach ($data as $d) {
             $student = [];
             $student['email'] = $d['email'];
             $save_data = $d;
             unset($save_data['fields']);
             if ($student_data = Student::updateOrCreate($student, $save_data)) {
                 foreach ($d['fields'] as $key => $item) {
                     $item['student_id'] = $student_data->id;
                     $field_data = [];
                     $field_data['title'] = $item['title'];
                     $field_data['student_id'] = $student_data->id;
                     Field::updateOrCreate($field_data,$item);
                 }
             }
         }
    }
}
