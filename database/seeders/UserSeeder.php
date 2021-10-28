<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory()
            ->has(
                Note::factory(['is_daily' => true])
                    ->sequence(fn ($sequence) => [
                        // Generate notes from today to x days in the past, simulating sustained use over multiple days.
                        'title' => Carbon::now()->subDays($sequence->index)->toFormattedDateString()
                    ])
                    ->count(10)
            )
            ->create(['email' => 'hello@seanwash.com']);
    }
}
