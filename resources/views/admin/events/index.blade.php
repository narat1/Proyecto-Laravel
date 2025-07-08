@extends('layouts.admin')

@section('content')

<div class="p-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Eventos</h1>

        <a href="{{ route('admin.events.create') }}"
       class="bg-pet-yellow hover:bg-pet-yellow-dark text-black font-bold px-6 py-3 rounded-lg items-center space-x-2">
       <i class="fas fa-plus mr-2"></i>Crear Evento
        </a>
    </div>

    {{-- Buscador --}}
    <div class="mb-6">
        <form method="GET" action="{{ route('admin.events.index') }}" class="relative">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Buscar por nombre" 
                   class="w-full max-w-md px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            <button type="submit" class="hidden">Buscar</button>
        </form>
    </div>

    {{-- Mensajes de éxito o error --}}
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    {{-- Eventos --}}
    @if($events->isEmpty())
        <p class="text-center text-gray-500">No hay eventos disponibles.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($events as $event)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if($event->image)
                        <img src="{{ asset($event->image) }}" alt="Imagen del evento" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                            Sin imagen
                        </div>
                    @endif

                    <div class="p-4">
                        <h2 class="text-lg font-semibold mb-2">{{ $event->name }}</h2>
                        <p class="text-sm text-gray-600 mb-2">Inicio: {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }}</p>

                        <a href="{{ route('admin.events.show', $event->id) }}"
                           class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm">
                            Ver detalles
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection
