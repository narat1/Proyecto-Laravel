@extends('layouts.admin')

@section('content')
    <div class="p-8">
        <div class="bg-white rounded-2xl shadow-2xl border border-gray-200 overflow-hidden">

            <div class="bg-yellow-400 py-4 px-10 flex items-center">
                <a href="{{ route('admin.adoption-requests.index') }}"
                    class="mr-4 text-gray-800 hover:text-gray-900 focus:outline-none transition-colors duration-200">
                    <i class="fas fa-arrow-left text-xl"></i>
                </a>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Detalles de Solicitud de Adopción</h1>
            </div>

            <div class="p-10 space-y-8">

                <div class="bg-white p-8 rounded-xl shadow-xl border border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 border-b border-gray-300 pb-4">Información del Adoptante</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">Nombre</label>
                            <input type="text" value="{{ $adoptionRequest->user->name ?? 'N/A' }}" readonly
                                class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-lg">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">Apellido</label>
                            <input type="text" value="{{ $adoptionRequest->user->last_name ?? 'N/A' }}" readonly
                                class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-lg">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">DNI</label>
                            <input type="text" value="{{ $adoptionRequest->user->dni ?? 'N/A' }}" readonly
                                class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-lg">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">Celular</label>
                            <input type="text" value="{{ $adoptionRequest->user->phone ?? 'N/A' }}" readonly
                                class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-lg">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="bg-white p-8 rounded-xl shadow-xl border border-gray-200">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 border-b border-gray-300 pb-4">Información de la Mascota</h2>
                        <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                            <div class="flex-shrink-0 w-32 h-32 md:w-48 md:h-48 rounded-xl overflow-hidden shadow-md border border-gray-200">
                                <img src="{{ $adoptionRequest->pet->photo_path ? asset('storage/' . $adoptionRequest->pet->photo_path) : asset('images/default_pet_image.png') }}"
                                    alt="{{ $adoptionRequest->pet->name ?? 'Mascota sin nombre' }}"
                                    class="w-full h-full object-cover">
                            </div>
                            <div class="flex-grow text-center md:text-left">
                                <p class="text-xl font-bold text-gray-900 mb-2">{{ $adoptionRequest->pet->name ?? 'Mascota no encontrada' }}</p>
                                <a href="{{ route('admin.pets.show', $adoptionRequest->pet->id) }}"
                                    class="inline-flex items-center px-4 py-2 text-pet-yellow hover:bg-yellow-100 hover:text-pet-yellow-dark font-semibold text-sm rounded-lg transition-colors duration-200 border border-yellow-200 shadow-sm">
                                    <i class="fas fa-paw mr-2"></i> Ver Perfil Completo
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-xl shadow-xl border border-gray-200">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 border-b border-gray-300 pb-4">Motivo de la Adopción</h2>
                        <div>
                            <textarea readonly rows="6"
                                class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-lg resize-y">{{ $adoptionRequest->message ?? 'No especificado' }}</textarea>
                        </div>
                    </div>
                </div>

                @if($adoptionRequest->admin_notes)
                    <div class="bg-white p-8 rounded-xl shadow-xl border border-gray-200">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 border-b border-gray-300 pb-4">Notas del Administrador</h2>
                        <div>
                            <textarea readonly rows="4"
                                class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-lg resize-y">{{ $adoptionRequest->admin_notes }}</textarea>
                        </div>
                    </div>
                @endif

                <div class="bg-white p-8 rounded-xl shadow-xl border border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 border-b border-gray-300 pb-4">Estado de la Solicitud</h2>
                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Estado actual</label>
                        <div class="px-4 py-2">
                            <span class="px-4 py-2 rounded-full text-base font-semibold
                                {{ $adoptionRequest->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $adoptionRequest->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $adoptionRequest->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ $adoptionRequest->status_in_spanish }}
                            </span>
                        </div>
                    </div>
                </div>

            </div> {{-- Fin del Contenido Principal de la Solicitud (p-10 space-y-8) --}}

            <div class="px-10 py-6 border-t border-gray-200 flex justify-end space-x-4 bg-gray-50 rounded-b-2xl">
                @if($adoptionRequest->status === 'pending')
                    <form action="{{ route('admin.adoption-requests.process', $adoptionRequest) }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="approved">
                        <button type="button" onclick="confirmApprove(this.form)"
                            class="px-8 py-3 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg text-lg transition-colors duration-200 shadow-md">
                            Aprobar
                        </button>
                    </form>

                    <form action="{{ route('admin.adoption-requests.process', $adoptionRequest) }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="rejected">
                        <button type="button" onclick="confirmReject(this.form)"
                            class="px-8 py-3 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-lg text-lg transition-colors duration-200 shadow-md">
                            Rechazar
                        </button>
                    </form>
                @else
                    <a href="{{ route('admin.adoption-requests.edit', $adoptionRequest) }}"
                        class="px-8 py-3 bg-pet-yellow hover:bg-pet-yellow-dark text-black font-semibold rounded-lg text-lg transition-colors duration-200 shadow-md">
                        Editar Solicitud
                    </a>
                @endif
            </div>
        </div> {{-- Fin del Contenedor Principal (bg-white rounded-2xl shadow-2xl) --}}
    </div> {{-- Fin del p-8 --}}

    <div id="approveModal" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 hidden">
        <div class="bg-white rounded-t-xl rounded-b-xl max-w-md w-full mx-4 overflow-hidden shadow-xl">
            <div class="bg-pet-yellow px-6 py-4 flex justify-between items-center">
                <h3 class="font-bold text-xl text-gray-900">Confirmar Aprobación</h3>
                <button onclick="closeModal('approveModal')"
                    class="text-gray-900 hover:text-gray-700 transition-colors duration-200">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="p-8 text-center">
                <p class="text-xl font-semibold mb-6 text-gray-800">¿Desea aprobar la solicitud de adopción?</p>
                <div class="flex justify-center space-x-4">
                    <button id="approveConfirmBtn"
                        class="px-8 py-3 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg text-lg transition-colors duration-200 shadow-md">
                        Aprobar
                    </button>
                    <button onclick="closeModal('approveModal')"
                        class="px-8 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded-lg text-lg transition-colors duration-200 shadow-md">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 hidden">
        <div class="bg-white rounded-t-xl rounded-b-xl max-w-md w-full mx-4 overflow-hidden shadow-xl">
            <div class="bg-pet-yellow px-6 py-4 flex justify-between items-center">
                <h3 class="font-bold text-xl text-gray-900">Confirmar Rechazo</h3>
                <button onclick="closeModal('rejectModal')"
                    class="text-gray-900 hover:text-gray-700 transition-colors duration-200">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="p-8 text-center">
                <p class="text-xl font-semibold mb-6 text-gray-800">¿Desea rechazar la solicitud de adopción?</p>
                <div class="flex justify-center space-x-4">
                    <button id="rejectConfirmBtn"
                        class="px-8 py-3 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-lg text-lg transition-colors duration-200 shadow-md">
                        Rechazar
                    </button>
                    <button onclick="closeModal('rejectModal')"
                        class="px-8 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded-lg text-lg transition-colors duration-200 shadow-md">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let approveForm = null;
        let rejectForm = null;

        function confirmApprove(form) {
            approveForm = form;
            const modal = document.getElementById('approveModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex'); // Usa 'flex' para centrar el modal
        }

        function confirmReject(form) {
            rejectForm = form;
            const modal = document.getElementById('rejectModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex'); // Usa 'flex' para centrar el modal
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.getElementById('approveConfirmBtn').addEventListener('click', function () {
            if (approveForm) {
                approveForm.submit();
            }
        });

        document.getElementById('rejectConfirmBtn').addEventListener('click', function () {
            if (rejectForm) {
                rejectForm.submit();
            }
        });

        // Añadir event listeners para cerrar modales con la tecla Escape
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeModal('approveModal');
                closeModal('rejectModal');
            }
        });
    </script>
@endsection