<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PoiCompany;

class PoiCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            ['company_name' => "Amazon", 'status' => '1',],
        ];
        foreach ($states as $key => $state) {
            PoiCompany::create($state);
        }
    }
}
