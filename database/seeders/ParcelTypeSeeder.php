<?php

namespace Database\Seeders;

use App\Models\ParcelType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParcelTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'سكني',
            'زراعي',
            'تجاري',
        ];

        foreach ($types as $single) {
            $type = new ParcelType();
            $type->name = $single;
            $type->save();
        }
    }
}
