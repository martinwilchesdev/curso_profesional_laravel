<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // al ejecutarse el seeder crea un usuario con un email definido por defectdo
        User::factory()->create([
            'name' => 'Test user',
            'email' => 'martin@gmail.com']
        );

        // se crean 19 usuarios adicionales, cada uno con un post asociado
        User::factory(19)->hasPosts()->create();
    }
}
