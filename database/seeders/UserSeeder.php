<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    // Admin
    User::create([
        'name' => 'Admin Principal',
        'email' => 'admin@wewire.test',
        'password' => Hash::make('password'),
        'role' => 'admin',
    ]);

    // Technicien 1
    User::create([
        'name' => 'Technicien A',
        'email' => 'tech1@wewire.test',
        'password' => Hash::make('password'),
        'role' => 'technicien',
    ]);

    // Technicien 2
    User::create([
        'name' => 'Technicien B',
        'email' => 'tech2@wewire.test',
        'password' => Hash::make('password'),
        'role' => 'technicien',
    ]);
}
}
