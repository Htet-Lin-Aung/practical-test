<?php

namespace App\Listeners;

use App\Events\SurveyCreated;
use App\Notifications\SurveyForm;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendSurveyCreatedNotifications
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SurveyCreated $event): void
    {
        Notification::send($event->user,new SurveyForm());
    }
}
