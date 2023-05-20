<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Competitor;

class CreateCompetitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            ['company_name' => "Criterion Group", 'status' => '1',],
            ['company_name' => "Industrial Outdoor", 'status' => '1',],
            ['company_name' => "RealTerm Logistics", 'status' => '1',],
        ];
        foreach ($states as $key => $state) {
            Competitor::create($state);
        }
    }
}
