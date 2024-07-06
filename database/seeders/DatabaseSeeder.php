<?php

namespace Database\Seeders;


use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Event as EventFacade;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        EventFacade::fake();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Event::withoutEvents(function () {
            Event::factory(40)->create();
        });


    }
}
