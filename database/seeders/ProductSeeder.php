<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'admin_id' => 2,
                'name_ar' => 'اسوس فيفو بوك S14 S5406SA-PP017W لاب توب - انتل® كور™ الترا 7-256V - رامات 16 جيجا بايت - هارد ديسك 1 تيرا بايت SSD - جرافيك Intel® Arc™ Graphics - شاشه 14\" OLED - ويندوز 11 - ازرق',
                'name_en' => 'ASUS VivoBook S14 S5406SA-PP017W Laptop - Intel® Core™ Ultra 7-256V - 16GB RAM - 1TB SSD - Intel® Arc™ Graphics - 14\" OLED Screen - Windows 11 - Blue',
                'description_ar' => 'اسوس فيفو بوك S14 S5406SA-PP017W لاب توب - انتل® كور™ الترا 7-256V - رامات 16 جيجا بايت - هارد ديسك 1 تيرا بايت SSD - جرافيك Intel® Arc™ Graphics - شاشه 14\" OLED - ويندوز 11 - ازرق',
                'description_en' => 'ASUS VivoBook S14 S5406SA-PP017W Laptop - Intel® Core™ Ultra 7-256V - 16GB RAM - 1TB SSD - Intel® Arc™ Graphics - 14\" OLED Screen - Windows 11 - Blue',
                'product_price' => 13000,
                'minimum_bid' => 0,
                'start_price' => 10000,
                'ticket_price' => 200,
                'start_time' => '2025-02-06 09:54:53',
                'end_time' => '2025-02-07 10:09:53',
                'status' => 1,
            ],
            [
                'id' => 2,
                'admin_id' => 2,
                'name_ar' => 'اسوس فيفو بوك S14 S5406SA-PP017Wص لاب توب - انتل® كور™ الترا 7-256V - رامات 16 جيجا بايت - هارد ديسك 1 تيرا بايت SSD - جرافيك Intel® Arc™ Graphics - شاشه 14\" OLED - ويندوز 11 - ازرق',
                'name_en' => 'ASUS VivoBook S14 S5406SA-PP017Ww Laptop - Intel® Core™ Ultra 7-256V - 16GB RAM - 1TB SSD - Intel® Arc™ Graphics - 14\" OLED Screen - Windows 11 - Blue',
                'description_ar' => 'اسوس فيفو بوك S14 S5406SA-PP017Ww لاب توب - انتل® كور™ الترا 7-256V - رامات 16 جيجا بايت - هارد ديسك 1 تيرا بايت SSD - جرافيك Intel® Arc™ Graphics - شاشه 14\" OLED - ويندوز 11 - ازرق',
                'description_en' => 'ASUS VivoBook S14 S5406SA-PP017Ww Laptop - Intel® Core™ Ultra 7-256V - 16GB RAM - 1TB SSD - Intel® Arc™ Graphics - 14\" OLED Screen - Windows 11 - Blue',
                'product_price' => 13000,
                'minimum_bid' => 0,
                'start_price' => 10000,
                'ticket_price' => 200,
                'start_time' => '2025-02-07 06:54:53',
                'end_time' => '2025-02-19 10:09:53',
                'status' => 1,
            ]
        ];
        foreach ($data as $item) {
            Product::create($item);
        }
    }
}
