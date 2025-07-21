<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear un usuario administrador con API key
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'api_key' => Str::random(32),
            'email_verified_at' => now(),
        ]);

        // Crear algunos usuarios adicionales
        User::factory(5)->create()->each(function ($user) {
            $user->api_key = Str::random(32);
            $user->save();
        });
    }
}
