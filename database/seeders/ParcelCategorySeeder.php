<?php

namespace Database\Seeders;

use App\Models\ParcelCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParcelCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'شهادة بحث',
            'حيازة',
            'مقنن',
        ];

        foreach ($types as $single) {
            $type = new ParcelCategory();
            $type->name = $single;
            $type->save();
        }
    }
}
