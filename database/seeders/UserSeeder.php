<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(User::count() < 10) {

            User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
            ]);
            
            User::factory(10)->create();
        }
    }
}
