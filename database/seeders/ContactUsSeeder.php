<?php

namespace Database\Seeders;

use App\Models\ContactUs;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ContactUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Contact Demo Data
        $jsonString = File::get(storage_path('data/contact/contact_demo_data.json'));

        $data = json_decode($jsonString, true);
        foreach ($data as $item) {
            $contact = [];
            $contact['email'] = $item['email'];
            if ($contact_data = ContactUs::updateOrCreate($contact, $item)) {

            }
        }
    }
}
