<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => Hash::make('password'),
                'remember_token' => null,
            ]
        ];

        for($i = 1; $i <= 10; $i++)
        {
            array_push($users, [
                'id'             => $i+1,
                'name'           => 'Employee ' . $i,
                'email'          => 'employee' . $i . '@employee' . $i . '.com',
                'password'       => Hash::make('password'),
                'remember_token' => null,
            ]);
        }

        User::insert($users);
    }
}
