<?php

namespace App\Listeners;

use App\Events\DishCreated;
use App\Mail\DishCreated as DishCreatedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class SendDishCreatedNotification
{
    public function handle(DishCreated $event): void
    {
        Mail::to(Auth::user())->send(new DishCreatedMail($event->dish));
    }
} 