<?php

namespace App\Observers;

use App\Constant\EventStatus;
use App\Models\Event;
use App\Notifications\EventNotification;
use Illuminate\Support\Facades\Notification;

class EventObserver
{
    /**
     * Handle the Event "created" event.
     */
    public function created(Event $event): void
    {
        Notification::send($event->user, new EventNotification(
            $event->user->name,
            $event->title,
            EventStatus::CREATED
        ));
    }

    /**
     * Handle the Event "updated" event.
     */
    public function updated(Event $event): void
    {
        Notification::send($event->user, new EventNotification(
            $event->user->name,
            $event->title,
            EventStatus::UPDATED
        ));
    }

    /**
     * Handle the Event "deleted" event.
     */
    public function deleted(Event $event): void
    {
        Notification::send($event->user, new EventNotification(
            $event->user->name,
            $event->title,
            EventStatus::DELETED
        ));
    }

    /**
     * Handle the Event "restored" event.
     */
    public function restored(Event $event): void
    {
        //
    }

    /**
     * Handle the Event "force deleted" event.
     */
    public function forceDeleted(Event $event): void
    {
        //
    }
}
