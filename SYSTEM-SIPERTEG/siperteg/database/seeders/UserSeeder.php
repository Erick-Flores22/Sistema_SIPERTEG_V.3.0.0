<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'cobrador@example.com'],
            [
                'name' => 'Cobrador',
                'password' => Hash::make('password'),
                'role' => 'cobrador',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'tecnico@example.com'],
            [
                'name' => 'Tecnico',
                'password' => Hash::make('password'),
                'role' => 'tecnico',
                'email_verified_at' => now(),
            ]
        );
    }
}
