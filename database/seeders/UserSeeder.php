<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'admin',
                'email' => 'admin@mail.com',
                'password' => bcrypt('qweewq'),
                'role' => 1              
            ],[
                'name' => 'anton',
                'email' => 'anton@mail.com',
                'password' => bcrypt('qweewq'),                                
                'role' => 2
            ],[
                'name' => 'tini',
                'email' => 'tini@mail.com',
                'password' => bcrypt('qweewq'),                
                'role' => 3
            ],[
                'name' => 'yuni',
                'email' => 'yuni@mail.com',
                'password' => bcrypt('qweewq'),                
                'role' => 4
            ]
            ];
        foreach ($data as $value) {
            User::create($value);
        }
    }
}
