<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $events = Event::when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%");
        })
        ->orderBy('start_date', 'asc')->get();

        return view('admin.events.index', compact('events', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|min:10',
            'capacity' => 'required|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'limit_date' => 'required|date|before_or_equal:start_date',
            'image' => 'nullable|image|max:2048',
        ], [
            'name.required' => 'El nombre del evento es requerido',
            'description.required' => 'La descripción es requerida',
            'capacity.required' => 'Debe indicar la capacidad del evento',
            'capacity.integer' => 'La capacidad debe ser un número entero',
            'start_date.required' => 'La fecha de inicio es requerida',
            'end_date.after_or_equal' => 'La fecha de fin debe ser después que la de inicio',
            'limit_date.before_or_equal' => 'La fecha límite debe ser antes que la de inicio',
            'image.image' => 'La imagen debe ser una imagen',
            'image.max' => 'La imagen no puede ser mayor a 2MB',
        ]);

        if ($request->hasFile('image')) {
            $ruta = $request->file('image')->store('event_images');
            $validated['image'] = str_replace('public/', 'storage/', $ruta);
        }

        Event::create($validated);

        return redirect()->route('admin.events.index')->with('success', 'Evento creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::with('volunteers')->findOrFail($id);
        return view('admin.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'capacity' => 'required|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'limit_date' => 'required|date|before_or_equal:start_date',
            'image' => 'nullable|image|max:2048',
        ], [
            'name.required' => 'El nombre del evento es requerido',
            'description.required' => 'La descripción es requerida',
            'capacity.required' => 'Debe indicar la capacidad del evento',
            'end_date.after_or_equal' => 'La fecha de fin debe ser después que la de inicio',
            'limit_date.before_or_equal' => 'La fecha límite debe ser igual o antes que la de inicio',
            'image.max' => 'La imagen no puede ser mayor a 2MB',
        ]);

        if ($request->hasFile('image')) {
            $ruta = $request->file('image')->store('public/event_images');
            $validated['image'] = str_replace('public/', 'storage/', $ruta);
        }

        $event->update($validated);

        return redirect()->route('admin.events.index')->with('success', 'Evento actualizado');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);

        // 1. Eliminar la imagen del evento si existe
        if ($event->image && Storage::exists(str_replace('storage/', 'public/', $event->image))) {
            Storage::delete(str_replace('storage/', 'public/', $event->image));
        }

        $event->volunteers()->detach();

        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Evento eliminado correctamente.');
    }
}
