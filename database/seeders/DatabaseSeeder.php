<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\ParcelCategory;
use App\Models\ParcelType;
use App\Models\Setting;
use App\Models\SpaceType;
use App\Models\State;
use App\Models\TypeAppartment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        if (!Setting::find(1))
            $this->call(SettingSeeder::class);
        if (!User::find(1))
            $this->call(AdminSeed::class);
        if (State::count() == 0)
            $this->call(StateSeeder::class);
        if (City::count() == 0)
            $this->call(CitySeeder::class);

        if (ParcelType::count() == 0)
            $this->call(ParcelTypeSeeder::class);
        if (ParcelCategory::count() == 0)
            $this->call(ParcelCategorySeeder::class);
        if (SpaceType::count() == 0)
            $this->call(SpaceTypeseeder::class);
    }
}