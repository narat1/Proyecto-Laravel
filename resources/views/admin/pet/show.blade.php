@extends('layouts.admin')

@section('content')
<div class="p-8">
    <div class="bg-white rounded-2xl shadow-2xl border border-gray-200 overflow-hidden">

        <div class="bg-yellow-400 py-6 px-10 flex items-center">
            <a href="{{ route('admin.pets.index') }}" class="mr-4 text-gray-800 hover:text-gray-900 focus:outline-none transition-colors duration-200">
                <i class="fas fa-arrow-left text-2xl"></i>
            </a>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Detalles de {{ $pet->name }}</h1>
        </div>

        <div class="p-10 grid grid-cols-1 md:grid-cols-5 gap-10 items-stretch">

            <div class="space-y-10 md:col-span-2">

                <div class="bg-white p-8 rounded-xl shadow-xl border border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 border-b border-gray-300 pb-4">Información Básica</h2>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <p class="text-base font-bold text-gray-800 mb-1.5">Nombre</p>
                            <p class="font-normal text-xl text-gray-700">{{ $pet->name }}</p>
                        </div>
                        <div>
                            <p class="text-base font-bold text-gray-800 mb-1.5">Edad</p>
                            <p class="font-normal text-xl text-gray-700">{{ $pet->age }} {{ $pet->age == 1 ? 'año' : 'años' }}</p>
                        </div>
                        <div>
                            <p class="text-base font-bold text-gray-800 mb-1.5">Especie</p>
                            <p class="font-normal text-xl text-gray-700">{{ $pet->type_in_spanish }}</p>
                        </div>
                        <div>
                            <p class="text-base font-bold text-gray-800 mb-1.5">Raza</p>
                            <p class="font-normal text-xl text-gray-700">{{ $pet->breed }}</p>
                        </div>
                        <div>
                            <p class="text-base font-bold text-gray-800 mb-1.5">Sexo</p>
                            <p class="font-normal text-xl text-gray-700">{{ $pet->gender_in_spanish }}</p>
                        </div>
                        <div>
                            <p class="text-base font-bold text-gray-800 mb-1.5">Tamaño</p>
                            <p class="font-normal text-xl text-gray-700">{{ $pet->size_in_spanish }}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-base font-bold text-gray-800 mb-1.5">Estado</p>
                            <p>
                                <span class="px-4 py-1.5 rounded-full text-sm font-bold tracking-wide
                                    {{ $pet->status === 'available' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $pet->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $pet->status === 'adopted' ? 'bg-blue-100 text-blue-800' : '' }}">
                                    {{ $pet->status_in_spanish }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 border-b border-gray-300 pb-4">Estado de Salud</h2>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <p class="text-base font-bold text-gray-800 mb-1.5">Vacunado</p>
                            <p class="font-normal text-xl text-gray-700">{{ $pet->is_vaccinated ? 'Sí' : 'No' }}</p>
                        </div>
                        <div>
                            <p class="text-base font-bold text-gray-800 mb-1.5">Esterilizado</p>
                            <p class="font-normal text-xl text-gray-700">{{ $pet->is_sterilized ? 'Sí' : 'No' }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 border-b border-gray-300 pb-4">Descripción</h2>
                    <p class="text-gray-700 text-lg leading-relaxed font-normal">{{ $pet->description }}</p>
                </div>

                <div class="pt-4">
                    <a href="{{ route('admin.pets.edit', $pet) }}"
                       class="w-full inline-flex items-center justify-center px-8 py-3 bg-pet-yellow hover:bg-pet-yellow-dark text-black font-semibold rounded-lg text-lg transition-colors duration-200 shadow-md">
                        <i class="fas fa-edit mr-3"></i> Editar Mascota
                    </a>
                </div>
            </div>

            <div class="p-8 bg-white rounded-xl shadow-xl border border-gray-200 flex items-center justify-center md:col-span-3 h-full">
                @if($pet->images && count($pet->images) > 0)
                    <img src="{{ Storage::url($pet->images[0]) }}"
                         alt="{{ $pet->name }}"
                         class="w-full h-full object-contain rounded-lg shadow-md"> {{-- Usar object-contain para asegurar que la imagen completa sea visible --}}
                @else
                    <div class="w-full h-full bg-gray-50 rounded-lg flex flex-col items-center justify-center shadow-inner border-2 border-dashed border-gray-300">
                        <i class="fas fa-paw text-7xl text-gray-400 mb-4"></i>
                        <p class="text-xl text-gray-500 font-medium">Sin foto</p>
                    </div>
                @endif
            </div>

        </div> {{-- Fin del grid principal --}}
    </div> {{-- Fin del Contenedor Principal (bg-white rounded-2xl shadow-2xl) --}}
</div> {{-- Fin del p-8 --}}
@endsection