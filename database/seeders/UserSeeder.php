<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario administrador
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@academic-templates.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // Usuarios de prueba
        User::factory(10)->create();
    }
}
