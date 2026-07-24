<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('countries')->delete();

        $countries = [
            ['name' => 'Afghanistan'],
            ['name' => 'Albania'],
            ['name' => 'Algeria'],
            ['name' => 'Argentina'],
            ['name' => 'Australia'],
            ['name' => 'Austria'],
            ['name' => 'Bangladesh'],
            ['name' => 'Belgium'],
            ['name' => 'Brazil'],
            ['name' => 'Canada'],
            ['name' => 'China'],
            ['name' => 'Denmark'],
            ['name' => 'Egypt'],
            ['name' => 'France'],
            ['name' => 'Germany'],
            ['name' => 'India'],
            ['name' => 'Indonesia'],
            ['name' => 'Iran'],
            ['name' => 'Iraq'],
            ['name' => 'Italy'],
            ['name' => 'Japan'],
            ['name' => 'Malaysia'],
            ['name' => 'Mexico'],
            ['name' => 'Netherlands'],
            ['name' => 'New Zealand'],
            ['name' => 'Nigeria'],
            ['name' => 'Norway'],
            ['name' => 'Pakistan'],
            ['name' => 'Philippines'],
            ['name' => 'Qatar'],
            ['name' => 'Russia'],
            ['name' => 'Saudi Arabia'],
            ['name' => 'Singapore'],
            ['name' => 'South Africa'],
            ['name' => 'South Korea'],
            ['name' => 'Spain'],
            ['name' => 'Sri Lanka'],
            ['name' => 'Sweden'],
            ['name' => 'Switzerland'],
            ['name' => 'Thailand'],
            ['name' => 'Turkey'],
            ['name' => 'United Arab Emirates'],
            ['name' => 'United Kingdom'],
            ['name' => 'United States'],
        ];

        DB::table('countries')->insert($countries);
    }
}
