<?php

namespace Database\Seeders;

use App\Models\ReitCompany;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReitCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            ['company_name' => "PS Business Parks", 'status' => '1',],
            ['company_name' => "Duke Realty", 'status' => '1',],
            ['company_name' => "EastGroup Properties", 'status' => '1',],
            ['company_name' => "First Industrial Realty Trust", 'status' => '1',],
            ['company_name' => "Royal Oak Realty Trust", 'status' => '1',],
            ['company_name' => "Watson Land Company", 'status' => '1',],
            ['company_name' => "GTJ Reit, Inc.", 'status' => '1',],
            ['company_name' => "Indus Realty Trust", 'status' => '1',],
            ['company_name' => "Americold Realty Trust", 'status' => '1',],
            ['company_name' => "LXP Industrial Trust", 'status' => '1',],
            ['company_name' => "Stag Industrial", 'status' => '1',],
            ['company_name' => "Industrial Logistics Properties Trust", 'status' => '1',],
            ['company_name' => "Ares", 'status' => '1',],
            ['company_name' => "Rexford Industrial Realty, Inc.", 'status' => '1',],
            ['company_name' => "Terreno", 'status' => '1',],
        ];
        foreach ($states as $key => $state) {
            ReitCompany::create($state);            
        }
    }
}
