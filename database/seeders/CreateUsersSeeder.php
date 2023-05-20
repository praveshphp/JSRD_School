<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $users = [
            [
                'name' => 'Pravesh',
                'email' => 'pravesh@developingnow.com',
                'type' => 1,
                'password' => bcrypt('Blacktop@123!'),
            ],
            [
                'name' => 'Hooman',
                'email' => 'hooman@developingnow.com',
                'type' => 1,
                'password' => bcrypt('Blacktop@123!'),
            ],
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }

}
