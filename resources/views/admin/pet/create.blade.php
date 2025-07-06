@extends('layouts.admin')

@section('content')
<div class="p-8">
    <div class="bg-white rounded-2xl shadow-2xl border border-gray-200 overflow-hidden">

        <div class="bg-yellow-400 py-4 px-10 flex items-center">
            <a href="{{ route('admin.pets.index') }}" class="mr-4 text-gray-800 hover:text-gray-900 focus:outline-none transition-colors duration-200">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Agregar Mascotaaa</h1>
        </div>

        <form action="{{ route('admin.pets.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="p-10 space-y-8">
                <div class="bg-white p-8 rounded-xl shadow-xl border border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 border-b border-gray-300 pb-4">Información Principal</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-bold text-gray-800 mb-1.5">Nombre</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg
                                          focus:ring-2 focus:ring-yellow-400 focus:outline-none
                                          placeholder-gray-500 transition duration-150 ease-in-out">
                            @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="age" class="block text-sm font-bold text-gray-800 mb-1.5">Edad</label>
                            <input type="number" name="age" id="age" value="{{ old('age') }}" min="0" max="20"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg
                                          focus:ring-2 focus:ring-yellow-400 focus:outline-none
                                          placeholder-gray-500 transition duration-150 ease-in-out">
                            @error('age') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="type" class="block text-sm font-bold text-gray-800 mb-1.5">Especie</label>
                            <select name="type" id="type"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg
                                           focus:ring-2 focus:ring-yellow-400 focus:outline-none
                                           appearance-none bg-white pr-8 transition duration-150 ease-in-out">
                                <option value="">Seleccionar...</option>
                                <option value="dog" {{ old('type') == 'dog' ? 'selected' : '' }}>Perro</option>
                                <option value="cat" {{ old('type') == 'cat' ? 'selected' : '' }}>Gato</option>
                                <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>Otro</option>
                            </select>
                            @error('type') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="gender" class="block text-sm font-bold text-gray-800 mb-1.5">Sexo</label>
                            <select name="gender" id="gender"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg
                                           focus:ring-2 focus:ring-yellow-400 focus:outline-none
                                           appearance-none bg-white pr-8 transition duration-150 ease-in-out">
                                <option value="">Seleccionar...</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Macho</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Hembra</option>
                            </select>
                            @error('gender') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="breed" class="block text-sm font-bold text-gray-800 mb-1.5">Raza</label>
                            <input type="text" name="breed" id="breed" value="{{ old('breed') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg
                                          focus:ring-2 focus:ring-yellow-400 focus:outline-none
                                          placeholder-gray-500 transition duration-150 ease-in-out">
                            @error('breed') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="size" class="block text-sm font-bold text-gray-800 mb-1.5">Tamaño</label>
                            <select name="size" id="size"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg
                                           focus:ring-2 focus:ring-yellow-400 focus:outline-none
                                           appearance-none bg-white pr-8 transition duration-150 ease-in-out">
                                <option value="">Seleccionar...</option>
                                <option value="small" {{ old('size') == 'small' ? 'selected' : '' }}>Pequeño</option>
                                <option value="medium" {{ old('size') == 'medium' ? 'selected' : '' }}>Mediano</option>
                                <option value="large" {{ old('size') == 'large' ? 'selected' : '' }}>Grande</option>
                            </select>
                            @error('size') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white p-8 rounded-xl shadow-xl border border-gray-200">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 border-b border-gray-300 pb-4">Salud</h2>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input type="checkbox" name="is_vaccinated" id="is_vaccinated" value="1" {{ old('is_vaccinated') ? 'checked' : '' }}
                                       class="form-checkbox h-5 w-5 text-pet-yellow rounded
                                              focus:ring-pet-yellow-400 transition duration-150 ease-in-out">
                                <label for="is_vaccinated" class="ml-3 text-sm text-gray-700 font-medium">Vacunado</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="is_sterilized" id="is_sterilized" value="1" {{ old('is_sterilized') ? 'checked' : '' }}
                                       class="form-checkbox h-5 w-5 text-pet-yellow rounded
                                              focus:ring-pet-yellow-400 transition duration-150 ease-in-out">
                                <label for="is_sterilized" class="ml-3 text-sm text-gray-700 font-medium">Esterilizado</label>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-xl shadow-xl border border-gray-200">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 border-b border-gray-300 pb-4">Descripción</h2>
                        <div>
                            <label for="description" class="sr-only">Descripción</label>
                            <textarea name="description" id="description" rows="7"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg
                                             focus:ring-2 focus:ring-yellow-400 focus:outline-none
                                             placeholder-gray-500 transition duration-150 ease-in-out resize-y">{{ old('description') }}</textarea>
                            @error('description') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-xl border border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 border-b border-gray-300 pb-4">Foto de la Mascota</h2>
                    <div class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-lg p-8 text-center bg-gray-50 hover:bg-gray-100 transition duration-200 ease-in-out cursor-pointer"
                         onclick="document.getElementById('photo').click()">
                        <input type="file" name="photo" id="photo" accept="image/*" class="hidden" onchange="showPreview(event)">
                        <i class="fas fa-cloud-upload-alt text-6xl text-gray-400 mb-4"></i>
                        <p class="text-gray-700 text-lg font-semibold">Arrastra y suelta una imagen o haz clic para subir</p>
                        <p class="text-sm text-gray-500 mt-1">PNG, JPG, JPEG hasta 2MB</p>

                        <div id="preview-container" class="mt-8 hidden">
                            <img id="preview-image" src="" alt="Vista previa de la mascota" class="w-48 h-48 object-cover rounded-xl shadow-md border border-gray-200">
                            <p id="image-name" class="text-gray-600 text-sm mt-2 font-medium"></p>
                        </div>
                    </div>
                    @error('photo') <span class="text-red-500 text-sm mt-2">{{ $message }}</span> @enderror
                </div>

            </div>
            <div class="px-10 py-6 border-t border-gray-200 flex justify-end space-x-4 bg-gray-50 rounded-b-2xl">
                <a href="{{ route('admin.pets.index') }}"
                   class="px-8 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded-lg text-lg transition-colors duration-200 shadow-md">
                    Cancelar
                </a>
                <button type="submit"
                        class="px-8 py-3 bg-pet-yellow hover:bg-pet-yellow-dark text-black font-semibold rounded-lg text-lg transition-colors duration-200 shadow-md">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function showPreview(event) {
        const file = event.target.files[0];
        const previewImage = document.getElementById('preview-image');
        const previewContainer = document.getElementById('preview-container');
        const imageName = document.getElementById('image-name');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImage.classList.remove('hidden');
                previewContainer.classList.remove('hidden');
                imageName.textContent = file.name;
            }
            reader.readAsDataURL(file);
        } else {
            previewImage.src = '';
            previewImage.classList.add('hidden');
            previewContainer.classList.add('hidden');
            imageName.textContent = '';
        }
    }
</script>
@endsection