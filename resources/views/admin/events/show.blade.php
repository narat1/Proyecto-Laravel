@extends('layouts.admin')

@section('content')
<div class="p-8">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">

        @if($event->image)
            <img src="{{ asset('storage/' . $event->image) }}" alt="Imagen del evento" class="w-full h-64 object-cover">
        @else
            <div class="w-full h-64 bg-gray-200 flex items-center justify-center text-gray-500">
                Sin imagen
            </div>
        @endif

        <div class="p-6">
            <h1 class="text-3xl font-bold mb-4">{{ $event->name }}</h1>

            <p class="text-gray-700 mb-4"><span class="font-semibold">Descripción:</span><br>{{ $event->description }}</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <p><span class="font-semibold text-gray-700">Capacidad:</span> {{ $event->capacity }}</p>
                    <p><span class="font-semibold text-gray-700">Fecha de inicio:</span> {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }}</p>
                    <p><span class="font-semibold text-gray-700">Fecha de fin:</span> {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}</p>
                </div>
                <div>
                    <p><span class="font-semibold text-gray-700">Fecha límite de inscripción:</span> {{ \Carbon\Carbon::parse($event->limit_date)->format('d/m/Y') }}</p>
                    <p><span class="font-semibold text-gray-700">Registrados:</span> {{ $event->volunteers->count() }}</p>
                </div>
            </div>

            <a href="{{ route('admin.events.index') }}"
               class="inline-block bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded-lg">
                Volver a la lista
            </a>
        </div>
    </div>
</div>
@endsection
