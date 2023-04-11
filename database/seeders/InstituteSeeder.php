<?php

namespace Database\Seeders;

use App\Models\Institute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class InstituteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        //institute Demo Data
        $jsonString = File::get(storage_path('data/institute/institute_demo_data.json'));

        $data = json_decode($jsonString, true);
        foreach ($data as $item) {
            $institute = [];
            $institute['email'] = $item['email'];
            if ($institute_data = Institute::updateOrCreate($institute, $item)) {

            }
        }
    }
}
