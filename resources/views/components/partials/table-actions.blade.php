<div class="flex items-center space-x-3">
    @if($routeEdit)
        <a href="{{ route($routeEdit, $row->id) }}"
           class="text-indigo-600 hover:text-indigo-900 transition-colors duration-150">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
        </a>
    @endif

    @if($routeDestroy)
        <form action="{{ route($routeDestroy, $row->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="button"
                    onclick="confirmDelete(this)"
                    class="text-red-600 hover:text-red-900 transition-colors duration-150">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
            </button>
        </form>
    @endif
</div>