<nav class="flex mb-4" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        @foreach($breadcrumbs as $index => $breadcrumb)
            <li class="inline-flex items-center">
                @if($index > 0)
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 9 4-4-4-4"/>
                    </svg>
                @endif
                @if(isset($breadcrumb['route']) && $loop->remaining > 0)
                    <a href="{{ $breadcrumb['route'] }}"
                       class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        @if($index == 0)
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                 fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                            </svg>
                        @endif
                        {{ $breadcrumb['name'] }}
                    </a>
                @else
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">{{ $breadcrumb['name'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>

    @if($actionLink)
        <div class="ml-auto">
            <a href="{{ $actionLink }}"
               class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                <i class="fa-solid fa-plus mr-2"></i>Nuevo
            </a>
        </div>
    @endif
</nav>
