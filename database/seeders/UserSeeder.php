<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name'=>'ini akun Admin',
               'email'=>'admin@gmail.com',
                'level'=>'admin',
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'ini akun User (non admin)',
               'email'=>'user@gmail.com',
                'level'=>'cs',
               'password'=> bcrypt('123456'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
