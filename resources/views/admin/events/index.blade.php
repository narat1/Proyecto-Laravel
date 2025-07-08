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

    <div class="mb-6">
        <form method="GET" action="{{ route('admin.events.index') }}" class="relative">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Buscar por nombre" 
                   class="w-full max-w-md px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            <button type="submit" class="hidden">Buscar</button>
        </form>
    </div>

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

    @if($events->isEmpty())
        <p class="text-center text-gray-500">No hay eventos disponibles.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($events as $event)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if($event->image)
                        <a href=""><img src="{{ asset('storage/' . $event->image) }}" alt="Imagen del evento" class="w-full h-48 object-cover"></a>
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                            Sin imagen
                        </div>
                    @endif

                    <div class="p-4">
                            <h2 class="text-lg font-semibold mb-2">{{ $event->name }}</h2>
                            <p class="text-sm text-gray-600 mb-2">Fecha: {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}</p>
                            <div clas="flex gap-2 mt-4 items-center">
                                <a href="{{ route('admin.events.show', $event->id) }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-black font-semibold rounded-lg">Detalles</a>
                                <a href="{{ route('admin.events.edit', $event->id) }}" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-black font-semibold rounded-lg">Editar</a>
                                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('¿Está seguro que desea eliminar este evento?')" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-black px-4 h-[37px] font-semibold rounded-lg hover:bg-red-600">Eliminar</button>
                                </form>
                            </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection
