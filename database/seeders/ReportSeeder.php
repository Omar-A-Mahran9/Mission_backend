<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      Report::create([
        'name_ar' => 'تقرير عن مشكلة تقنية',
        'name_en' => 'Technical Issue Report',

      ]);
      Report::create([
        'name_ar' => 'عدم اكتمال المهمة من قبل الموظف المستقل',
        'name_en' => 'The freelancer failed to complete the task.',

      ]);
      Report::create([
        'name_ar' => 'رفض العميل قبول المهمة رغم انتهاء الموظف المستقل منها',
        'name_en' => 'The client refused to accept the task even though the freelancer had completed it.',

      ]);
      Report::create([
        'name_ar' => 'اخر',
        'name_en' => 'other',

      ]);
    }
}
