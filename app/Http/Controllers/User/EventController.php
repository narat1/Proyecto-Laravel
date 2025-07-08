<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('start_date', 'asc')->get();
        return view('user.events.index', compact('events'));
    }

    public function show($id)
    {
        $event = Event::with('volunteers')->findOrFail($id);
        return view('user.event.show', compact('event'));
    }

    public function inscribirse($eventId)
    {
        $user = auth()->user();
        $event = Event::findOrFail($eventId);

        // Evitar duplicados
        if ($event->volunteers()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'Ya está inscrito en este evento');
        }

        $event->volunteers()->attach($user->id);

        return back()->with('success', 'Inscrito');
    }
}
