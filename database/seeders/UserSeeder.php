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
      ], [
        'name' => 'sales1',
        'email' => 'sales1@mail.com',
        'password' => bcrypt('qweewq'),
        'role' => 2
      ], [
        'name' => 'sales2',
        'email' => 'sales2@mail.com',
        'password' => bcrypt('qweewq'),
        'role' => 2
      ], [
        'name' => 'purchases2',
        'email' => 'purchases2@mail.com',
        'password' => bcrypt('qweewq'),
        'role' => 3
      ], [
        'name' => 'purchases1',
        'email' => 'purchases@mail.com',
        'password' => bcrypt('qweewq'),
        'role' => 3
      ],
      [
        'name' => 'manager',
        'email' => 'manager@mail.com',
        'password' => bcrypt('qweewq'),
        'role' => 4
      ]
    ];
    foreach ($data as $value) {
      User::create($value);
    }
  }
}
