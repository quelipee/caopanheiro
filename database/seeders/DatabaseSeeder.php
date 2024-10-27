<?php

namespace Database\Seeders;

use App\Models\PetEntry;
use App\Models\User;
use App\User\enums\userType;
use Database\Seeders\PetEntrySeed;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'user_type' => userType::admin,
            'email' => 'admin@example.com',
            'password' => bcrypt('123456789'),
        ]);
        $this->call([
            PetEntrySeed::class,
        ]);
        // PetEntry::factory(10)->create();
        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
    }
}
