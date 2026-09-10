<div class="p-6 bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 col-span-full">
    <div class="flex items-center justify-between pb-4 mb-4 border-b border-gray-100 dark:border-gray-800">
        <div>
            <h2 class="text-base font-bold text-gray-900 dark:text-white flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ __('admin.recent_activity') }}
            </h2>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Real-time audit log of user actions (creates, updates, deletes)</p>
        </div>
        <a href="{{ \App\Filament\Resources\ActivityLogResource::getUrl('index') }}" class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">
            View All Logs →
        </a>
    </div>

    @php
        $activities = $this->getRecentActivities();
    @endphp

    @if($activities->count() > 0)
        <div class="divide-y divide-gray-100 dark:divide-gray-800">
            @foreach($activities as $activity)
                <div class="py-3 flex items-center justify-between gap-4 text-xs">
                    <div class="flex items-center gap-3">
                        @if($activity->action === 'created')
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300">
                                ✨ Created
                            </span>
                        @elseif($activity->action === 'updated')
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300">
                                ✏️ Updated
                            </span>
                        @else
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-rose-100 text-rose-800 dark:bg-rose-900/40 dark:text-rose-300">
                                🗑️ Deleted
                            </span>
                        @endif

                        <div>
                            <span class="font-bold text-gray-900 dark:text-gray-100">{{ $activity->user_name }}</span>
                            <span class="text-gray-500 font-mono text-[11px]">({{ $activity->user_role }})</span>
                            <span class="text-gray-600 dark:text-gray-400 ml-1">{{ $activity->description }}</span>
                        </div>
                    </div>

                    <div class="text-right whitespace-nowrap text-gray-400 font-mono">
                        {{ $activity->created_at->diffForHumans() }}
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-6 text-xs text-gray-500 dark:text-gray-400">
            No system activity recorded yet.
        </div>
    @endif
</div>
