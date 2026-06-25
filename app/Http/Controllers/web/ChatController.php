<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\Message;
use App\Events\MessageSent;

class ChatController extends Controller
{
    public function show(Trip $trip)
    {
        $user = auth()->user();

        $allowed = $trip->driver_id === $user->id
            || $trip->passengers()->where('user_id', $user->id)->exists();
            // هل المستخدم: سائق الرحلة؟ أوراكب داخل الرحلة؟

        abort_if(! $allowed, 403);

        $messages = $trip->messages()->with('sender')->get();

        return view('chat.show', compact('trip', 'messages'));
    }

    public function store(Request $request, Trip $trip)
    {
        $user = auth()->user();

        $allowed = $trip->driver_id === $user->id
            || $trip->passengers()->where('user_id', $user->id)->exists();

        abort_if(! $allowed, 403);

        $request->validate([
            'message' => 'required|string'
        ]);

        $message = Message::create([
            'trip_id' => $trip->id,
            'sender_id' => $user->id,
            'message' => $request->message,
        ]);

        // لو عندك realtime
        broadcast(new MessageSent($message))->toOthers();

        return back();
    }
}
