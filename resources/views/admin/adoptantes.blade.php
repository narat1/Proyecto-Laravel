<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - Pet Friendly</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>

    <style>
        .bg-pet-yellow {
            background-color: #FCD34D;
        }

        .hover\:bg-pet-yellow:hover {
            background-color: #F59E0B;
        }

        .text-pet-yellow {
            color: #F59E0B;
        }

        .bg-pet-yellow-dark {
            background-color: #F59E0B;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans">
    <div class="flex min-h-screen">
        <div class="w-64 bg-white shadow-lg">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-black rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-gray-900">PetFriendly</span>
                </div>
            </div>

            <nav class="p-4 space-y-2">
                <a href="{{ route('admin.adoptantes') }}"
                    class="flex items-center space-x-3 px-4 py-3 {{ request()->routeIs('admin.adoptantes') ? 'bg-pet-yellow text-black font-semibold' : 'text-gray-700 hover:bg-gray-100' }} rounded-lg">
                    <i class="fas fa-users"></i>
                    <span>Adoptantes</span>
                </a>

                <a href="{{ route('admin.pets.index') }}"
                    class="flex items-center space-x-3 px-4 py-3 {{ request()->routeIs('admin.pets.*') ? 'bg-pet-yellow text-black font-semibold' : 'text-gray-700 hover:bg-gray-100' }} rounded-lg">
                    <i class="fas fa-paw"></i>
                    <span>Mascotas</span>
                </a>

                <a href="{{ route('admin.adoption-requests.index') }}"
                    class="flex items-center space-x-3 px-4 py-3 {{ request()->routeIs('admin.adoption-requests.*') ? 'bg-pet-yellow text-black font-semibold' : 'text-gray-700 hover:bg-gray-100' }} rounded-lg">
                    <i class="fas fa-file-alt"></i>
                    <span>Solicitudes</span>
                </a>

                <a href="{{ route('admin.donations.index') }}"
                    class="flex items-center space-x-3 px-4 py-3 {{ request()->routeIs('admin.donations.*') ? 'bg-pet-yellow text-black font-semibold' : 'text-gray-700 hover:bg-gray-100' }} rounded-lg">
                    <i class="fas fa-heart"></i>
                    <span>Donaciones</span>
                </a>

                <a href="{{ route('admin.events.index') }}"
                    class="flex items-center space-x-3 px-4 py-3 {{ request()->routeIs('admin.events.*') ? 'bg-pet-yellow text-black font-semibold' : 'text-gray-700 hover:bg-gray-100' }} rounded-lg">
                    <i class="fas fa-heart"></i>
                    <span>Eventos</span>
                </a>
            </nav>

            <div class="absolute bottom-6 left-4 right-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg w-full">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Salir</span>
                    </button>
                </form>
            </div>
        </div>

        <div class="flex-1 p-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Lista de Adoptantes</h1>
            </div>

            @if(session('status') === 'adoptante-deleted')
                <script>
                    toastr.success('El adoptante ha sido eliminado exitosamente.');
                </script>
            @endif

            <div class="mb-6">
                <form method="GET" action="{{ route('admin.adoptantes') }}" class="flex gap-4">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Buscar por nombre o correo..."
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                    <button type="submit"
                        class="px-6 py-2 bg-pet-yellow hover:bg-pet-yellow-dark text-black font-semibold rounded-lg">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                    @if ($search)
                        <a href="{{ route('admin.adoptantes') }}"
                            class="px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-lg">
                            Limpiar
                        </a>
                    @endif
                </form>
            </div>

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="w-full table-auto">
                    <thead class="bg-pet-yellow">
                        <tr>
                            <th class="px-6 py-4 text-left text-black font-bold">Imagen</th>
                            <th class="px-6 py-4 text-left text-black font-bold">Nombre</th>
                            <th class="px-6 py-4 text-left text-black font-bold">Correo</th>
                            <th class="px-6 py-4 text-center text-black font-bold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($adoptantes as $adoptante)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <img src="{{ $adoptante->profile_photo_url }}" alt="Foto de perfil"
                                        class="w-12 h-12 rounded-full object-cover">
                                </td>
                                <td class="px-6 py-4 text-gray-900">{{ $adoptante->name }}</td>
                                <td class="px-6 py-4 text-gray-900">{{ $adoptante->email }}</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center space-x-2">
                                        <button onclick="viewAdoptante({{ $adoptante->id }})"
                                            class="p-2 text-blue-600 hover:bg-blue-100 rounded-lg" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button onclick="editAdoptante({{ $adoptante->id }})"
                                            class="p-2 text-green-600 hover:bg-green-100 rounded-lg" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="confirmDeleteAdoptante({{ $adoptante->id }})"
                                            class="p-2 text-red-600 hover:bg-red-100 rounded-lg" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    No se encontraron adoptantes.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($adoptantes->hasPages())
                <div class="mt-6 flex justify-center">
                    {{ $adoptantes->links() }}
                </div>
            @endif
        </div>
    </div>

    <div id="viewModal"
        class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 transition-opacity duration-300"
        style="display: none;">
        <div
            class="bg-white rounded-2xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto shadow-2xl transform transition-transform duration-300 ease-in-out scale-95 opacity-0 border border-gray-200">

            <div class="bg-yellow-400 py-7 px-10 rounded-t-2xl flex justify-between items-center">
                <h3 class="text-3xl font-bold text-gray-900 tracking-tight">Detalles del Adoptante</h3>
                <button onclick="closeModal()"
                    class="text-gray-500 hover:text-gray-800 focus:outline-none transition-colors duration-200">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>

            <div id="modalContent" class="p-10 space-y-10">
                </div>
        </div>
    </div>

    <script>
        // Configuración global de Toastr (opcional)
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        // Función para abrir el modal con detalles del adoptante
        function viewAdoptante(id) {
            fetch(`/admin/adoptantes/${id}/view`)
                .then(response => response.json())
                .then(data => {
                    const content = `
                        <div class="bg-white p-6 rounded-xl shadow-xl border border-gray-200">
                            <h4 class="text-2xl font-bold text-gray-900 mb-4 border-b border-gray-300 pb-3">Información Personal</h4>
                            <div class="p-4 rounded-lg bg-gray-50 shadow-md">
                                <p class="text-lg mb-1"><span class="font-semibold text-gray-700">Nombre:</span> <span class="text-gray-800">${data.user.name}</span></p>
                                <p class="text-lg mb-1"><span class="font-semibold text-gray-700">Correo:</span> <span class="text-gray-800">${data.user.email}</span></p>
                                <p class="text-lg mb-1"><span class="font-semibold text-gray-700">Fecha de Nacimiento:</span> <span class="text-gray-800">${new Date(data.user.birth_date).toLocaleDateString('es-ES', { year: 'numeric', month: 'long', day: 'numeric' })}</span></p>
                                <p class="text-lg"><span class="font-semibold text-gray-700">Registrado:</span> <span class="text-gray-800">${new Date(data.user.created_at).toLocaleDateString('es-ES', { year: 'numeric', month: 'long', day: 'numeric' })}</span></p>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                            <h4 class="font-bold text-2xl text-gray-900 mb-4 border-b border-gray-300 pb-3">Solicitudes de Adopción</h4>
                            <div class="space-y-6">
                                ${data.adoptionRequests.length > 0 ?
                                data.adoptionRequests.map(req => `
                                    <div class="p-4 rounded-lg bg-gray-50 shadow-md hover:bg-gray-100 transition-colors duration-200">
                                        <p class="text-lg mb-1"><span class="font-semibold text-gray-700">Mascota:</span> <span class="text-gray-800">${req.pet.name}</span></p>
                                        <p class="text-lg mb-1"><span class="font-semibold text-gray-700">Estado:</span> <span class="text-gray-800">${req.status}</span></p>
                                        <p class="text-lg"><span class="font-semibold text-gray-700">Mensaje:</span> <span class="text-gray-600 italic">${req.message || 'Sin mensaje'}</span></p>
                                    </div>
                                `).join('') :
                                '<p class="text-gray-500 text-lg italic p-4 bg-gray-100 rounded-lg border border-gray-200 shadow-md">No tiene solicitudes de adopción.</p>'}
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                            <h4 class="font-bold text-2xl text-gray-900 mb-4 border-b border-gray-300 pb-3">Donaciones</h4>
                            <div class="space-y-6">
                                ${data.donations.length > 0 ?
                                data.donations.map(don => `
                                    <div class="p-4 rounded-lg bg-gray-50 shadow-md hover:bg-gray-100 transition-colors duration-200">
                                        <p class="text-lg mb-1"><span class="font-semibold text-gray-700">Monto:</span> <span class="text-gray-800">S/ ${don.amount}</span></p>
                                        <p class="text-lg mb-1"><span class="font-semibold text-gray-700">Estado:</span> <span class="text-gray-800">${don.status}</span></p>
                                        <p class="text-lg"><span class="font-semibold text-gray-700">Fecha:</span> <span class="text-gray-800">${new Date(don.created_at).toLocaleDateString('es-ES', { year: 'numeric', month: 'long', day: 'numeric' })}</span></p>
                                    </div>
                                `).join('') :
                                '<p class="text-gray-500 text-lg italic p-4 bg-gray-100 rounded-lg border border-gray-200 shadow-md">No ha realizado donaciones.</p>'}
                            </div>
                        </div>
                    `;
                    document.getElementById('modalContent').innerHTML = content;
                    const viewModal = document.getElementById('viewModal');
                    viewModal.style.display = 'flex';
                    setTimeout(() => {
                        viewModal.querySelector('div').classList.remove('scale-95', 'opacity-0');
                        viewModal.querySelector('div').classList.add('scale-100', 'opacity-100');
                    }, 50); // Small delay for the transition to apply
                })
                .catch(error => {
                    console.error('Error:', error);
                    toastr.error('Error al cargar los detalles del adoptante.');
                });
        }

        function editAdoptante(id) {
            // Implementar edición
            Swal.fire({
                title: 'Función en desarrollo',
                text: 'La edición de adoptantes aún no está disponible.',
                icon: 'info',
                confirmButtonText: 'Entendido',
                confirmButtonColor: '#F59E0B'
            });
        }

        function confirmDeleteAdoptante(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Sí, eliminarlo!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteAdoptante(id);
                }
            });
        }

        function deleteAdoptante(id) {
            fetch(`/admin/adoptantes/${id}/delete`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        toastr.success('El adoptante ha sido eliminado exitosamente.');
                        location.reload();
                    } else {
                        toastr.error(data.error || 'Error al eliminar el adoptante.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    toastr.error('Error al eliminar el adoptante.');
                });
        }

        function closeModal() {
            const viewModal = document.getElementById('viewModal');
            viewModal.querySelector('div').classList.remove('scale-100', 'opacity-100');
            viewModal.querySelector('div').classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                viewModal.style.display = 'none';
            }, 300); // Wait for the transition to finish
        }

        // Close modal when clicking outside
        document.getElementById('viewModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
</body>

</html>