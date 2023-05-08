<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/data/countries.json");
        $countries = json_decode($json, true);
        foreach ($countries as $country) {
            Country::firstOrCreate(
                [
                    'id' => $country['id'],
                    'name' => $country['name']
                ],
                $country);
        }
    }
}
