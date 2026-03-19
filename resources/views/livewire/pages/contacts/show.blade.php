<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use App\Models\Contact;
use App\Models\ContactActivity;

new #[Layout('layouts.app'), Title('View Contact')] class extends Component {
    public Contact $contact;
    public array $requestLogs = [];

    public function mount(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Log a quick interaction (called, emailed)
     */
    public function logInteraction($type)
    {
        sleep(0.5); // Demo loading indicator

        $descriptions = [
            'called' => "Made a phone call to {$this->contact->name}",
            'emailed' => "Sent an email to {$this->contact->name}",
            'note_added' => "Added a note to {$this->contact->name}'s record",
        ];

        ContactActivity::create([
            'contact_id' => $this->contact->id,
            'type' => $type,
            'description' => $descriptions[$type] ?? "Logged '{$type}' interaction",
        ]);

        $this->contact->update(['last_contacted_at' => now()]);
        $this->contact->refresh();

        // Observer Pattern: dispatch for any listening components
        $this->dispatch('contactInteractionLogged', type: $type);
        $this->dispatch('show-toast', type: 'success', message: ucfirst($type) . ' interaction logged!');
    }

    #[Computed]
    public function activities()
    {
        return $this->contact->activities()->latest()->take(10)->get();
    }

    #[Computed]
    public function activityCount()
    {
        return $this->contact->activities()->count();
    }
}; ?>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <a href="{{ route('contacts.index') }}" wire:navigate
            class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
            ← Back to Contacts
        </a>
        <div class="flex items-center justify-between mt-2">
            <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">{{ $contact->name }}</h1>
            <a href="{{ route('contacts.edit', $contact) }}" wire:navigate
                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition text-sm font-medium">
                Edit Contact
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- ============================================================ --}}
        {{-- FEATURE 3: BASIC ISLAND — Contact Info Panel --}}
        {{-- ============================================================ --}}
        <div class="lg:col-span-1">
            @island
                <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-sm border border-zinc-200 dark:border-zinc-700 p-6">
                    <div class="text-center mb-6">
                        <div class="w-20 h-20 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center mx-auto mb-3">
                            <span class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">{{ strtoupper(substr($contact->name, 0, 2)) }}</span>
                        </div>
                        @php
                            $statusColors = ['active' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400', 'inactive' => 'bg-zinc-100 text-zinc-800 dark:bg-zinc-700 dark:text-zinc-300', 'lead' => 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400'];
                        @endphp
                        <span class="px-3 py-1 text-xs font-medium rounded-full {{ $statusColors[$contact->status] ?? '' }}">
                            {{ ucfirst($contact->status) }}
                        </span>
                    </div>

                    <dl class="space-y-4">
                        <div>
                            <dt class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Email</dt>
                            <dd class="text-sm text-zinc-900 dark:text-white mt-0.5">{{ $contact->email }}</dd>
                        </div>
                        @if($contact->phone)
                        <div>
                            <dt class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Phone</dt>
                            <dd class="text-sm text-zinc-900 dark:text-white mt-0.5">{{ $contact->phone }}</dd>
                        </div>
                        @endif
                        @if($contact->company)
                        <div>
                            <dt class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Company</dt>
                            <dd class="text-sm text-zinc-900 dark:text-white mt-0.5">{{ $contact->company }}</dd>
                        </div>
                        @endif
                        <div>
                            <dt class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Last Contacted</dt>
                            <dd class="text-sm text-zinc-900 dark:text-white mt-0.5">
                                {{ $contact->last_contacted_at ? $contact->last_contacted_at->diffForHumans() : 'Never' }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Created</dt>
                            <dd class="text-sm text-zinc-900 dark:text-white mt-0.5">{{ $contact->created_at->format('M d, Y') }}</dd>
                        </div>
                    </dl>

                    {{-- ============================================================ --}}
                    {{-- FEATURE 2: LOADING INDICATOR — Quick Action Buttons --}}
                    {{-- ============================================================ --}}
                    <div class="mt-6 space-y-2">
                        <p class="text-xs font-medium text-zinc-500 dark:text-zinc-400 mb-2">Quick Actions</p>
                        <button wire:click="logInteraction('called')"
                            class="w-full px-3 py-2 text-sm bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 rounded-md hover:bg-emerald-100 dark:hover:bg-emerald-900/30 transition font-medium">
                            <span wire:loading.remove wire:target="logInteraction('called')">📞 Mark as Called</span>
                            <span wire:loading wire:target="logInteraction('called')">Logging...</span>
                        </button>
                        <button wire:click="logInteraction('emailed')"
                            class="w-full px-3 py-2 text-sm bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-400 rounded-md hover:bg-blue-100 dark:hover:bg-blue-900/30 transition font-medium">
                            <span wire:loading.remove wire:target="logInteraction('emailed')">📧 Mark as Emailed</span>
                            <span wire:loading wire:target="logInteraction('emailed')">Logging...</span>
                        </button>
                    </div>

                    {{-- Nested Island: Last contacted timestamp --}}
                    @island
                        <p class="text-xs text-zinc-400 mt-3 text-center">Page rendered: {{ now()->format('H:i:s') }}</p>
                    @endisland
                </div>
            @endisland
        </div>

        {{-- ============================================================ --}}
        {{-- FEATURE 3: NESTED ISLAND — Activity Timeline --}}
        {{-- ============================================================ --}}
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-sm border border-zinc-200 dark:border-zinc-700 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white">Activity Timeline</h3>
                    <span class="text-sm text-zinc-500 dark:text-zinc-400">{{ $this->activityCount }} total</span>
                </div>

                @island
                    <div class="relative">
                        {{-- Timeline line --}}
                        <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-zinc-200 dark:bg-zinc-700"></div>

                        <div class="space-y-6">
                            @forelse($this->activities as $activity)
                                <div wire:key="timeline-{{ $activity->id }}" class="relative flex items-start gap-4 pl-10">
                                    {{-- Timeline dot --}}
                                    @php
                                        $dotColors = ['created' => 'bg-emerald-500', 'updated' => 'bg-blue-500', 'emailed' => 'bg-indigo-500', 'called' => 'bg-green-500', 'note_added' => 'bg-amber-500', 'status_changed' => 'bg-purple-500'];
                                    @endphp
                                    <div class="absolute left-2.5 w-3 h-3 rounded-full {{ $dotColors[$activity->type] ?? 'bg-zinc-400' }} ring-2 ring-white dark:ring-zinc-800"></div>

                                    <div class="flex-1 bg-zinc-50 dark:bg-zinc-900 rounded-lg p-4 border border-zinc-100 dark:border-zinc-800">
                                        <div class="flex items-center justify-between mb-1">
                                            <span class="text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase">{{ str_replace('_', ' ', $activity->type) }}</span>
                                            <span class="text-xs text-zinc-400">{{ $activity->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-sm text-zinc-800 dark:text-zinc-200">{{ $activity->description }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-zinc-500 text-center py-8">No activity recorded yet. Use the quick actions to log interactions.</p>
                            @endforelse
                        </div>
                    </div>
                @endisland
            </div>

            {{-- Notes Section --}}
            @if($contact->notes)
                <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-sm border border-zinc-200 dark:border-zinc-700 p-6 mt-8">
                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white mb-3">Notes</h3>
                    <p class="text-sm text-zinc-600 dark:text-zinc-400 whitespace-pre-wrap">{{ $contact->notes }}</p>
                </div>
            @endif
        </div>
    </div>

    {{-- Feature Explanations --}}
    <div class="mt-12 space-y-4">
        <h2 class="text-xl font-bold text-zinc-900 dark:text-white mb-4">🧪 Livewire 4 Features on This Page</h2>

        <details class="bg-gradient-to-r from-blue-50 to-cyan-50 dark:from-blue-900/20 dark:to-cyan-900/20 rounded-lg border border-blue-200 dark:border-blue-800 p-4">
            <summary class="font-semibold text-blue-900 dark:text-blue-100 cursor-pointer">🏝️ Feature: Basic + Nested Islands</summary>
            <div class="mt-3 text-sm text-blue-800 dark:text-blue-200 space-y-2">
                <p><strong>Where:</strong> The contact info sidebar is a <code>@island(name: 'contact-info')</code> with a nested <code>@island(name: 'last-action-time')</code>. The activity timeline is a separate <code>@island(name: 'activity-timeline')</code>.</p>
                <p><strong>How to test:</strong></p>
                <ol class="list-decimal list-inside space-y-1 ml-2">
                    <li>Click "Mark as Called" → the activity timeline island re-renders with the new entry, but the contact info island updates independently (last contacted time changes)</li>
                    <li>Open DevTools → search for <code>data-island</code> to see all 3 islands</li>
                    <li>The "Page rendered" timestamp in the nested island shows when that specific island last rendered</li>
                </ol>
            </div>
        </details>

        <details class="bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/20 dark:to-green-900/20 rounded-lg border border-emerald-200 dark:border-emerald-800 p-4">
            <summary class="font-semibold text-emerald-900 dark:text-emerald-100 cursor-pointer">⏳ Feature: Loading Indicators</summary>
            <div class="mt-3 text-sm text-emerald-800 dark:text-emerald-200 space-y-2">
                <p><strong>Where:</strong> The "Mark as Called" and "Mark as Emailed" quick action buttons.</p>
                <p><strong>How to test:</strong></p>
                <ol class="list-decimal list-inside space-y-1 ml-2">
                    <li>Click "📞 Mark as Called" → button text changes to "Logging..." for 0.5 seconds</li>
                    <li>The button auto-gets <code>data-loading</code> CSS (opacity + spinner)</li>
                    <li>A toast notification appears confirming the action</li>
                </ol>
            </div>
        </details>

        <details class="bg-gradient-to-r from-orange-50 to-amber-50 dark:from-orange-900/20 dark:to-amber-900/20 rounded-lg border border-orange-200 dark:border-orange-800 p-4">
            <summary class="font-semibold text-orange-900 dark:text-orange-100 cursor-pointer">🔌 Feature: Request Interceptors</summary>
            <div class="mt-3 text-sm text-orange-800 dark:text-orange-200 space-y-2">
                <p><strong>Where:</strong> The global interceptors from <code>app.blade.php</code> are active on this page. Every quick action click creates a Livewire request that is intercepted.</p>
                <p><strong>How to test:</strong></p>
                <ol class="list-decimal list-inside space-y-1 ml-2">
                    <li>Open browser DevTools → Console tab</li>
                    <li>Click "Mark as Called" → watch console show "🚀 Request sent" and "✅ Response received"</li>
                    <li>The global interceptor in <code>app.blade.php</code> handles 419/500 errors automatically</li>
                </ol>
            </div>
        </details>

        <details class="bg-gradient-to-r from-purple-50 to-violet-50 dark:from-purple-900/20 dark:to-violet-900/20 rounded-lg border border-purple-200 dark:border-purple-800 p-4">
            <summary class="font-semibold text-purple-900 dark:text-purple-100 cursor-pointer">👁️ Feature: Observer Pattern</summary>
            <div class="mt-3 text-sm text-purple-800 dark:text-purple-200 space-y-2">
                <p><strong>Where:</strong> Each quick action dispatches <code>contactInteractionLogged</code> event. The activity timeline and contact info both react by re-rendering — the timeline shows the new entry, and the "Last Contacted" field updates.</p>
                <p><strong>How to test:</strong></p>
                <ol class="list-decimal list-inside space-y-1 ml-2">
                    <li>Note "Last Contacted: Never" or an old date</li>
                    <li>Click "Mark as Called" → Last Contacted changes to "just now"</li>
                    <li>A new entry appears at the top of the Activity Timeline</li>
                </ol>
            </div>
        </details>
    </div>
</div>

@assets
<script>
    document.addEventListener('livewire:init', () => {
        // Page-level interceptor: log interactions to console
        Livewire.hook('request', ({ respond, succeed, fail }) => {
            console.log('🚀 [Contact Show] Request sent');

            respond(({ status }) => {
                console.log(`✅ [Contact Show] Response received (HTTP ${status})`);
            });

            fail(({ status }) => {
                console.error(`❌ [Contact Show] Request failed (HTTP ${status})`);
            });
        });
    });
</script>
@endassets
