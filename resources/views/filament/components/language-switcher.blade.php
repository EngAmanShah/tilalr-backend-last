<div x-data="{ open: false }" class="relative">
    <button
        @click="open = !open"
        class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 transition"
        type="button"
    >
        @if(app()->getLocale() === 'ar')
            <span class="fi fi-sa text-lg"></span>
            <span>العربية</span>
        @else
            <span class="fi fi-gb text-lg"></span>
            <span>English</span>
        @endif
        <svg class="h-4 w-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>

    <div
        x-show="open"
        @click.away="open = false"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute right-0 rtl:left-0 rtl:right-auto z-50 mt-2 w-40 origin-top-right rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5 dark:bg-gray-800 dark:ring-gray-700"
        style="display: none;"
    >
        <div class="py-1">
            <a
                href="{{ url()->current() }}?locale=en"
                class="flex items-center gap-3 px-4 py-2 text-sm {{ app()->getLocale() === 'en' ? 'bg-primary-50 text-primary-600 dark:bg-primary-900/50 dark:text-primary-400' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700' }}"
            >
                <span class="fi fi-gb text-lg"></span>
                <span>English</span>
                @if(app()->getLocale() === 'en')
                    <svg class="ml-auto h-4 w-4 text-primary-600 dark:text-primary-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                @endif
            </a>
            <a
                href="{{ url()->current() }}?locale=ar"
                class="flex items-center gap-3 px-4 py-2 text-sm {{ app()->getLocale() === 'ar' ? 'bg-primary-50 text-primary-600 dark:bg-primary-900/50 dark:text-primary-400' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700' }}"
            >
                <span class="fi fi-sa text-lg"></span>
                <span>العربية</span>
                @if(app()->getLocale() === 'ar')
                    <svg class="ml-auto rtl:mr-auto rtl:ml-0 h-4 w-4 text-primary-600 dark:text-primary-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                @endif
            </a>
        </div>
    </div>
</div>
