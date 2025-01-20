<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'admin',
            'email' => 'admin@webstdy.com',
            'password' => 'Admin@1234567',
            'phone' => '0503245843',
        ]);

        Admin::create([
            'name' => 'webstdy',
            'email' => 'support@webstdy.com',
            'password' => 'Support@1234567',
            'phone' => '0556963305',
        ]);
    }
}