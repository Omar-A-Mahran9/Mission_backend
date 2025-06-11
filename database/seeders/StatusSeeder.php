<?php

namespace Database\Seeders;

use App\Models\Status; // Ensure you're using the correct model
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Status::create([
        //     'name_ar' => 'قيد المراجعة',
        //     'name_en' => 'Under review',
        //     'color' => 'yellow',
        // ]);

        // Status::create([
        //     'name_ar' => 'جاري النشر',
        //     'name_en' => 'Publishing',
        //     'color' => 'blue',
        // ]);

        // Status::create([
        //     'name_ar' => 'تم القبول',
        //     'name_en' => 'Accepted',
        //     'color' => 'green',
        // ]);

        // Status::create([
        //     'name_ar' => 'تم الإلغاء',
        //     'name_en' => 'Cancelled',
        //     'color' => 'red',
        // ]);



        // Status::create([
        //     'name_ar' => 'تم الاستلام',
        //     'name_en' => 'received',
        //     'color' => '#66ffff',
        // ]);
        Status::create([
            'name_ar' => 'لم يتم الانتهاء',
            'name_en' => 'Not finished',
            'color' => '#666633',
        ]);
    }
}

