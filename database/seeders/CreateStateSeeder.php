<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;

class CreateStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            ['code' => "AL", 'state' => 'Alabama',],
            ['code' => "AK", 'state' => 'Alaska',],
            ['code' => "AZ", 'state' => 'Arizona',],
            ['code' => "AR", 'state' => 'Arkansas',],
            ['code' => "CA", 'state' => 'California',],
            ['code' => "CO", 'state' => 'Colorado',],
            ['code' => "CT", 'state' => 'Connecticut',],
            ['code' => "DE", 'state' => 'Delaware',],
            ['code' => "DC", 'state' => 'District Of Columbia',],
            ['code' => "FL", 'state' => 'Florida',],
            ['code' => "GA", 'state' => 'Georgia',],
            ['code' => "HI", 'state' => 'Hawaii',],
            ['code' => "ID", 'state' => 'Idaho',],
            ['code' => "IL", 'state' => 'Illinois',],
            ['code' => "IN", 'state' => 'Indiana',],
            ['code' => "IA", 'state' => 'Iowa',],
            ['code' => "KS", 'state' => 'Kansas',],
            ['code' => "KY", 'state' => 'Kentucky',],
            ['code' => "LA", 'state' => 'Louisiana',],
            ['code' => "ME", 'state' => 'Maine',],
            ['code' => "MD", 'state' => 'Maryland',],
            ['code' => "MA", 'state' => 'Massachusetts',],
            ['code' => "MI", 'state' => 'Michigan',],
            ['code' => "MN", 'state' => 'Minnesota',],
            ['code' => "MS", 'state' => 'Mississippi',],
            ['code' => "MO", 'state' => 'Missouri',],
            ['code' => "MT", 'state' => 'Montana',],
            ['code' => "NE", 'state' => 'Nebraska',],
            ['code' => "NV", 'state' => 'Nevada',],
            ['code' => "NH", 'state' => 'New Hampshire',],
            ['code' => "NJ", 'state' => 'New Jersey',],
            ['code' => "NM", 'state' => 'New Mexico',],
            ['code' => "NY", 'state' => 'New York',],
            ['code' => "NC", 'state' => 'North Carolina',],
            ['code' => "ND", 'state' => 'North Dakota',],
            ['code' => "OH", 'state' => 'Ohio',],
            ['code' => "OK", 'state' => 'Oklahoma',],
            ['code' => "OR", 'state' => 'Oregon',],
            ['code' => "PA", 'state' => 'Pennsylvania',],
            ['code' => "RI", 'state' => 'Rhode Island',],
            ['code' => "SC", 'state' => 'South Carolina',],
            ['code' => "SD", 'state' => 'South Dakota',],
            ['code' => "TN", 'state' => 'Tennessee',],
            ['code' => "TX", 'state' => 'Texas',],
            ['code' => "UT", 'state' => 'Utah',],
            ['code' => "VT", 'state' => 'Vermont',],
            ['code' => "VA", 'state' => 'Virginia',],
            ['code' => "WA", 'state' => 'Washington',],
            ['code' => "WV", 'state' => 'West Virginia',],
            ['code' => "WI", 'state' => 'Wisconsin',],
            ['code' => "WY", 'state' => 'Wyoming',],
        ];

        foreach ($states as $key => $state) {
            State::create($state);
        }
    }
}
