<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['key' => 'site_name', 'value' => 'Webstdy'],
            ['key' => 'address', 'value' => 'شارع أحمد بن حنبل، حي اليريان، الرياض، المملكة العربية السعودية'],
            ['key' => 'phone', 'value' => '+966551646971'],
            ['key' => 'email', 'value' => 'asdad@info.com'],
            ['key' => 'time_left_to_pay', 'value' => '24'], // 24 hours
        ];

        foreach ($data as $setting) {
            Setting::create($setting);
        }
    }
}
