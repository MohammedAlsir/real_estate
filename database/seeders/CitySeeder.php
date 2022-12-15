<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->delete();

        $cities =
            [
                1 => [
                    [
                        'name' => 'الخرطوم',
                        // 'name_en' => 'Khartoum'
                    ],
                    [
                        'name' => 'أم درمان',
                        // 'name_en' => 'Omdrman',
                    ],
                    [
                        'name' => 'بحري',
                        // 'name_en' => 'Bahry',
                    ],
                ],
                2 => [
                    [
                        'name' => 'نهر عطبرة',
                        // 'name_en' => 'نهر عطبرة',
                    ],
                ]
            ];

        $index = 1;

        foreach ($cities as  $index => $single) {
            if ($index == 0)
                $index++;
            foreach ($single as  $item) {
                // State::create(['name' => $state]);
                $city = new City();
                $city->name = $item['name'];
                // $city->name_en = $item['name_en'];
                $city->state_id = $index;

                $city->save();
            }
        }
    }
}