<?php

namespace Database\Seeders;

use App\Models\SpaceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpaceTypeseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'فدان',
            'متر',
        ];

        foreach ($types as $single) {
            $type = new SpaceType();
            $type->name = $single;
            $type->save();
        }
    }
}