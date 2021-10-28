<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory()
            ->has(Note::factory(['is_daily' => true])->count(10))
            ->create(['email' => 'hello@seanwash.com']);
    }
}
