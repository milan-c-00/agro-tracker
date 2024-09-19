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
    protected $emails = ['admin@mailinator.com', 'admin2@mailinator.com', 'admin3@mailinator.com'];

    public function run(): void
    {
        foreach ($this->emails as $email) {
            User::factory()->state(function (array $attributes) use ($email) {
                return [
                    'email' => $email,
                ];
            })->create();
        }
    }
}
