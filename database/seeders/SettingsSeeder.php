<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::create([
            'name' => 'Art Seller',
            'email' => 'artseller@neuralwebx.com',
            'phone' => '+8801878005537',
            'address' => 'Uttara, Dhaka-1230',
            'logo' => 'nabil.png',
            'favicon' => 'nabil.png',
            'linkedin' => 'https://linkedin.com/in/neuralwebx',
            'facebook' => 'https://facebook.com/neuralwebx',
        ]);
    }
}
