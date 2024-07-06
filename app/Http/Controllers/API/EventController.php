<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventStoreRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Event::class);

        return EventResource::collection(Event::paginate(10));
    }

    public function store(EventStoreRequest $request, EventService $eventService): JsonResponse
    {
        $event = $eventService->store($request);
        return response()->json([
            'message' => 'Event created successfully',
            'data' => EventResource::make($event),
        ], Response::HTTP_CREATED);
    }

    public function show(Event $event): EventResource
    {
        Gate::authorize('view', $event);

        return EventResource::make($event);
    }

    public function update(EventUpdateRequest $request, Event $event, EventService $eventService): JsonResponse
    {
        $updatedEvent = $eventService->update($request, $event);

        return response()->json([
            'message' => 'Event updated successfully',
            'data' => EventResource::make($updatedEvent),
        ], Response::HTTP_OK);
    }

    public function destroy(Event $event): JsonResponse
    {
        Gate::authorize('delete', $event);
        $event->delete();

        return response()->json([
            'message' => 'Event deleted successfully',
        ], Response::HTTP_NO_CONTENT);
    }
}
