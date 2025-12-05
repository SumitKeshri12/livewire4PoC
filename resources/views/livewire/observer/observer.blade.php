<div
    class="p-6 bg-white rounded-xl border-2 border-gray-200 shadow-md transition-all duration-300 hover:shadow-xl hover:border-green-300">
    <div class="flex justify-between items-start mb-4">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                    <path fill-rule="evenodd"
                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div>
                <h3 class="text-base font-bold text-gray-800">{{ $name }}</h3>
                <p class="text-xs text-gray-500">Listening for events</p>
            </div>
        </div>
        <div class="flex flex-col items-end gap-1">
            <span
                class="px-3 py-1 text-xs font-bold text-green-800 bg-green-100 rounded-full border border-green-300 flex items-center gap-1">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                {{ $updateCount }} Updates
            </span>
            <span class="text-xs text-gray-400 flex items-center gap-1">
                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                Active
            </span>
        </div>
    </div>

    <div class="space-y-3">
        <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                </path>
            </svg>
            <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold">Observed Value</p>
        </div>
        <div
            class="p-4 bg-gradient-to-br from-gray-50 to-green-50 border-2 border-gray-200 rounded-lg font-mono text-gray-800 min-h-[4rem] flex items-center transition-all duration-300 {{ $observedState !== 'Waiting for updates...' ? 'border-green-300 bg-green-50' : '' }}">
            <span
                class="{{ $observedState === 'Waiting for updates...' ? 'text-gray-400 italic' : 'text-gray-900 font-semibold' }}">
                {{ $observedState }}
            </span>
        </div>
    </div>

    <div class="mt-4 pt-3 border-t border-gray-200 flex items-center gap-2">
        <svg class="w-4 h-4 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                clip-rule="evenodd" />
        </svg>
        <span class="text-xs text-gray-500 italic">
            Listening for <code class="bg-gray-100 px-1 rounded text-blue-600">stateUpdated</code> event
        </span>
    </div>
</div>
