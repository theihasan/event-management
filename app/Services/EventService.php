<?php

namespace App\Services;

use App\Http\Requests\EventStoreRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Models\Event;
use Illuminate\Support\Facades\Gate;

class EventService
{

    public function store(EventStoreRequest $request)
    {
        Gate::authorize('create', Event::class);
        $eventData = $request->validated();
        $eventData['user_id'] = auth()->id();
        return Event::create($eventData);
    }

    public function update(EventUpdateRequest $request, Event $event)
    {
        Gate::authorize('update', $event);
        $event->update($request->validated());
        return $event;
    }


}
