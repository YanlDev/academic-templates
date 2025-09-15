<div class="relative inline-block text-left" x-data="{ open: false }">
    <div>
        <button type="button"
                @click="open = !open"
                class="flex items-center text-gray-400 hover:text-gray-600 transition-colors duration-150"
                aria-expanded="true" aria-haspopup="true">
            <span class="sr-only">Abrir menu</span>
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
            </svg>
        </button>
    </div>

    <div x-show="open"
         x-cloak
         @click.away="open = false"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="origin-top-right absolute right-0 mt-2 w-32 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
        <div class="py-1" role="menu" aria-orientation="vertical">
            @if($routeEdit)
                <a href="{{ route($routeEdit, $row->id) }}"
                   class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150"
                   role="menuitem">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Editar
                </a>
            @endif

            @if($routeDestroy)
                <form action="{{ route($routeDestroy, $row->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button"
                            onclick="confirmDelete(this)"
                            class="flex items-center w-full px-4 py-2 text-sm text-red-700 hover:bg-red-50 transition-colors duration-150"
                            role="menuitem">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Eliminar
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>