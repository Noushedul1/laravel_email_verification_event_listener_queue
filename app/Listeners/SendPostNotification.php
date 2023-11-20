<?php

namespace App\Listeners;

use App\Models\User;
use App\Mail\UserMail;
use App\Events\PostProcessed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPostNotification
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
    public function handle(PostProcessed $event): void
    {
        // Mail::to(Auth::user()->email)->send(new UserMail($event->post));
        //for single user
        //for all user
        $users = User::all();
        foreach($users as $user){
            Mail::to($user->email)->send(new UserMail($event->post));
        }
    }
}
