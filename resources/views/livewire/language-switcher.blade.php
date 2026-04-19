<div x-data="{ open: false }" class="relative" wire:key="language-switcher">
    <button
        @click="open = !open"
        class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-white/5 transition"
        type="button"
    >
        @if($currentLocale === 'ar')
            <span class="h-5 w-5 text-2xl leading-none" role="img" aria-label="Saudi Arabia flag">🇸🇦</span>
            <span>العربية</span>
        @else
            <svg class="h-5 w-5" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                <rect fill="#00247d" height="32" width="32"/>
                <path d="M0,0 L32,32 M32,0 L0,32" stroke="#fff" stroke-width="4"/>
                <path d="M0,0 L32,32 M32,0 L0,32" stroke="#cf142b" stroke-width="2"/>
                <path d="M16,0 V32 M0,16 H32" stroke="#fff" stroke-width="8"/>
                <path d="M16,0 V32 M0,16 H32" stroke="#cf142b" stroke-width="4"/>
            </svg>
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
        class="absolute {{ $currentLocale === 'ar' ? 'left-0' : 'right-0' }} z-50 mt-2 w-40 origin-top-right rounded-lg bg-white shadow-lg ring-1 ring-black/5 dark:bg-gray-900 dark:ring-white/10"
        style="display: none;"
    >
        <div class="py-1">
            <button
                wire:click="switchLocale('en')"
                class="flex w-full items-center gap-3 px-4 py-2 text-sm {{ $currentLocale === 'en' ? 'bg-primary-50 text-primary-600 dark:bg-primary-500/10 dark:text-primary-400' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-white/5' }}"
            >
                <svg class="h-5 w-5 shrink-0" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                    <rect fill="#00247d" height="32" width="32"/>
                    <path d="M0,0 L32,32 M32,0 L0,32" stroke="#fff" stroke-width="4"/>
                    <path d="M0,0 L32,32 M32,0 L0,32" stroke="#cf142b" stroke-width="2"/>
                    <path d="M16,0 V32 M0,16 H32" stroke="#fff" stroke-width="8"/>
                    <path d="M16,0 V32 M0,16 H32" stroke="#cf142b" stroke-width="4"/>
                </svg>
                <span>English</span>
                @if($currentLocale === 'en')
                    <svg class="ms-auto h-4 w-4 text-primary-600 dark:text-primary-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                @endif
            </button>
            <button
                wire:click="switchLocale('ar')"
                class="flex w-full items-center gap-3 px-4 py-2 text-sm {{ $currentLocale === 'ar' ? 'bg-primary-50 text-primary-600 dark:bg-primary-500/10 dark:text-primary-400' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-white/5' }}"
            >
                <span class="h-5 w-5 shrink-0 text-2xl leading-none" role="img" aria-label="Saudi Arabia flag">🇸🇦</span>
                <span>العربية</span>
                @if($currentLocale === 'ar')
                    <svg class="ms-auto h-4 w-4 text-primary-600 dark:text-primary-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                @endif
            </button>
        </div>
    </div>
</div>
