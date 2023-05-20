<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Region;

class CreateRegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            ['city' => "Tampa", 'state_id' => '10',],
            ['city' => "Fort Myers", 'state_id' => '10',],
            ['city' => "Jacksonville", 'state_id' => '10',],
            ['city' => "Savannah", 'state_id' => '11',],
            ['city' => "Charleston", 'state_id' => '41',],
        ];
        foreach ($states as $key => $state) {
            Region::create($state);
        }
    }
}
