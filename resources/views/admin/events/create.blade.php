@extends('layouts.admin')

@section('content')

<div class="max-w-4xl mx-auto p-8">
    <h1 class="text-3xl font-bold mb-6">Crear Nuevo Evento</h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            Hubo algún problema
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block font-medium">Nombre del evento</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                   class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>

        <div>
            <label for="image" class="block font-medium">Imagen (opcional)</label>
            <input type="file" name="image" id="image"
                   class="w-full border border-gray-300 rounded px-4 py-2">
        </div>

        <div>
            <label for="description" class="block font-medium">Descripción</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="capacity" class="block font-medium">Capacidad</label>
            <input type="number" name="capacity" id="capacity" value="{{ old('capacity') }}"
                   min="1"
                   class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="start_date" class="block font-medium">Fecha de inicio</label>
                <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}"
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>

            <div>
                <label for="end_date" class="block font-medium">Fecha de fin</label>
                <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>

            <div>
                <label for="limit_date" class="block font-medium">Fecha límite inscripción</label>
                <input type="date" name="limit_date" id="limit_date" value="{{ old('limit_date') }}"
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>
        </div>

        <div class="flex justify-end pt-4">
            <a href="{{ route('admin.events.index') }}" class="text-gray-600 hover:underline mr-4">Cancelar</a>
            <button type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded shadow">
                Crear Evento
            </button>
        </div>
    </form>
</div>

@endsection
