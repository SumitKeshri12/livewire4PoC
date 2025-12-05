<div class="p-6 bg-gradient-to-br from-white to-blue-50 rounded-xl shadow-lg border-2 border-blue-200">
    <div class="flex items-center gap-2 mb-4">
        <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                </path>
            </svg>
        </div>
        <div>
            <h3 class="text-lg font-bold text-gray-800">Subject (Publisher)</h3>
            <p class="text-xs text-gray-500">Broadcasts state changes</p>
        </div>
    </div>

    <p class="mb-4 text-sm text-gray-600">
        Type in the box below. This component will <strong>broadcast</strong> the state change to all listening
        Observers.
    </p>

    <div class="flex flex-col gap-3">
        <label for="state" class="text-sm font-semibold text-gray-700 flex items-center gap-2">
            <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                    clip-rule="evenodd" />
            </svg>
            Current State:
        </label>
        <input type="text" wire:model.live="state" id="state"
            class="border-2 border-blue-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-lg shadow-sm w-full p-3 text-gray-800 font-medium transition-all"
            placeholder="Type something...">

        <div class="bg-blue-100 border-l-4 border-blue-500 p-3 rounded-r-lg">
            <div class="flex items-center gap-2 mb-1">
                <svg class="w-4 h-4 text-blue-600 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                </svg>
                <span class="text-xs font-semibold text-blue-800">Broadcasting Event:</span>
            </div>
            <code class="text-sm font-mono text-blue-900 bg-blue-50 px-2 py-1 rounded block">
                {{ $state ?: '(empty)' }}
            </code>
        </div>
    </div>
</div>
