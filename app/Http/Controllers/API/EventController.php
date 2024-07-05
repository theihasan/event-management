<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventStoreRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return EventResource::collection(Event::paginate(10));
    }

    public function store(EventStoreRequest $request)
    {
        $eventData = $request->validated();
        $eventData['user_id'] = auth()->id();
        Event::create($eventData);
        return response()->json([
            'message' => 'Event created successfully',
        ], 201);
    }

    public function show(Event $event): EventResource
    {
        return EventResource::make($event);
    }

    public function update(EventUpdateRequest $request, Event $event): JsonResponse
    {
        $event->update($request->validated());
        return response()->json([
            'message' => 'Event updated successfully',
        ]);
    }

    public function destroy(Event $event): JsonResponse
    {
        $event->delete();
        return response()->json([
            'message' => 'Event deleted successfully',
        ]);
    }
}
