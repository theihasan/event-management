<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use Mockery;
use Tests\TestCase;

class EventControllerTest extends TestCase
{
   use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_index_returns_a_collection_of_events()
    {
        //Arrange
        $this->withoutExceptionHandling();
        $events = Event::factory(2)->create();
        $this->assertCount(2, Event::all());
        Gate::shouldReceive('authorize')->with('viewAny', Event::class)->andReturn(true);

        //Act
        $response = $this->getJson(route('events.index'));

        //Arrange
        $response->assertJsonCount(2, 'data');
        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'title', 'description', 'date','location']
            ]
        ]);

    }

    public function test_store_saves_a_new_event_in_the_database()
    {
        //Arrange
        $this->withoutExceptionHandling();
        $data = Event::factory()->make()->toArray();
        $data['user_id'] = $this->user->id;
        Gate::shouldReceive('authorize')->with('create', Event::class)->andReturn(true);

        //Act
        $response = $this->postJson(route('events.store'), $data);

        //Assert
        $response->assertCreated();
        $this->assertDatabaseHas('events', $data);
    }

    public function test_show_returns_a_valid_event()
    {
        //Arrange
        $this->withoutExceptionHandling();
        $event = Event::factory()->create();
        Gate::shouldReceive('authorize')
            ->with('view', Mockery::on(function ($arg) use ($event) {
                return $arg->is($event);
            }));
        //Act
        $response = $this->getJson(route('events.show', $event));

        //Assert
        $response->assertJson([
            'data' => [
                'id' => $event->id,
                'title' => $event->title,
                'description' => $event->description,
                'date' => $event->date,
                'location' => $event->location,
            ]
        ]);
    }

    public function test_update_saves_a_new_event_in_the_database()
    {
        //Arrange
        $this->withoutExceptionHandling();
        $event = Event::factory()->create();
        $data = Event::factory()->make()->toArray();
        Gate::shouldReceive('authorize')
            ->with('update', Mockery::on(function ($arg) use ($event) {
                return $arg->is($event);
            }));

        //Act
        $response = $this->putJson(route('events.update', $event), $data);

        //Assert
        $response->assertOk();
        $this->assertDatabaseHas('events', $data);
    }

    public function test_destroy_removes_the_event_from_the_database()
    {
        //Arrange
        $this->withoutExceptionHandling();
        $event = Event::factory()->create();
        Gate::shouldReceive('authorize')
            ->with('delete', Mockery::on(function ($arg) use ($event) {
                return $arg->is($event);
            }));

        //Act
        $response = $this->deleteJson(route('events.destroy', $event));

        //Assert
        $response->assertNoContent();
        $this->assertDatabaseMissing('events', $event->toArray());
    }



}
