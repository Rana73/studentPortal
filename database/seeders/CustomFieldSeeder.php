<?php

namespace Database\Seeders;

use App\Models\CustomField;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CustomFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Custome field Demo Data
        $jsonString = File::get(storage_path('data/custom_field/custom_field_demo_data.json'));

        $data = json_decode($jsonString, true);
        foreach ($data as $item) {
            $custome_field = [];
            $custome_field['institute_id'] = $item['institute_id'];
            $custome_field['title'] = $item['title'];
            $custome_field['type'] = $item['type'];
            if ($custome_field_data = CustomField::updateOrCreate($custome_field, $item)) {

            }
        }
    }
}
