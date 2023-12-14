<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Araksya',
            'email' => 'arsuvan73@gmail.com',
            'password' => Hash::make('hayk2019')
        ]);
    }
}
