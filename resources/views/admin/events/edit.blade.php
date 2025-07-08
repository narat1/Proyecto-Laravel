@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto p-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Editar Evento</h1>

    @if ($errors->any())
        <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4">
            <p><strong>Se encontraron errores:</strong></p>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.events.update', $event->id) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium text-gray-700">Nombre</label>
            <input type="text" name="name" value="{{ old('name', $event->name) }}" class="w-full px-4 py-2 border rounded-lg" required>
        </div>

        <div>
            <label class="block font-medium text-gray-700">Descripción</label>
            <textarea name="description" rows="4" class="w-full px-4 py-2 border rounded-lg" required>{{ old('description', $event->description) }}</textarea>
        </div>

        <div>
            <label class="block font-medium text-gray-700">Capacidad</label>
            <input type="number" name="capacity" value="{{ old('capacity', $event->capacity) }}" class="w-full px-4 py-2 border rounded-lg" required>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block font-medium text-gray-700">Fecha de inicio</label>
                <input type="date" name="start_date" value="{{ old('start_date', $event->start_date) }}" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Fecha de fin</label>
                <input type="date" name="end_date" value="{{ old('end_date', $event->end_date) }}" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Fecha límite</label>
                <input type="date" name="limit_date" value="{{ old('limit_date', $event->limit_date) }}" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
        </div>

        <div>
            <label class="block font-medium text-gray-700">Imagen (opcional)</label>
            <input type="file" name="image" class="block mt-1">
            @if($event->image)
                <p class="mt-2 text-sm text-gray-600">Imagen actual:</p>
                <img src="{{ asset($event->image) }}" alt="Imagen actual" class="w-64 h-auto mt-2 rounded">
            @endif
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.events.index') }}" class="px-6 py-2 bg-gray-300 text-black rounded-lg hover:bg-gray-400">
                Cancelar
            </a>
            <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>
@endsection
