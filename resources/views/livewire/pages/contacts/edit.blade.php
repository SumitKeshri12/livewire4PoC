<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use App\Models\Contact;
use App\Models\ContactActivity;

new #[Layout('layouts.app'), Title('Edit Contact')] class extends Component {
    public Contact $contact;

    #[Rule('required|string|min:2|max:255')]
    public string $name = '';

    #[Rule('required|email')]
    public string $email = '';

    #[Rule('nullable|string|max:20')]
    public string $phone = '';

    #[Rule('nullable|string|max:255')]
    public string $company = '';

    #[Rule('required|in:active,inactive,lead')]
    public string $status = 'lead';

    #[Rule('nullable|string')]
    public string $notes = '';

    // Observer Pattern: track status changes
    public string $previousStatus = '';
    public string $statusChangeMessage = '';

    // Island Load More state
    public int $activityLimit = 3;

    public function mount(Contact $contact)
    {
        $this->contact = $contact;
        $this->name = $contact->name;
        $this->email = $contact->email;
        $this->phone = $contact->phone ?? '';
        $this->company = $contact->company ?? '';
        $this->status = $contact->status;
        $this->notes = $contact->notes ?? '';
        $this->previousStatus = $contact->status;
    }

    /**
     * Observer Pattern: React to status changes
     */
    public function updated($property)
    {
        if ($property === 'status' && $this->status !== $this->previousStatus) {
            $this->statusChangeMessage = "Status changing from \"{$this->previousStatus}\" → \"{$this->status}\"";
        } else {
            $this->statusChangeMessage = '';
        }
    }

    public function update()
    {
        $validated = $this->validate();

        // Check if email changed (unique validation needs to exclude current)
        if ($this->email !== $this->contact->email) {
            $this->validate(['email' => "required|email|unique:contacts,email,{$this->contact->id}"]);
        }

        $oldStatus = $this->contact->status;
        $this->contact->update($validated);

        // Log the update activity
        ContactActivity::create([
            'contact_id' => $this->contact->id,
            'type' => 'updated',
            'description' => "Contact details were updated",
        ]);

        // Log status change if it changed
        if ($oldStatus !== $this->status) {
            ContactActivity::create([
                'contact_id' => $this->contact->id,
                'type' => 'status_changed',
                'description' => "Status changed from '{$oldStatus}' to '{$this->status}'",
            ]);
        }

        $this->previousStatus = $this->status;
        $this->statusChangeMessage = '';

        $this->dispatch('contactUpdated');
        $this->dispatch('show-toast', type: 'success', message: "Contact '{$this->name}' updated successfully!");
        $this->redirect(route('contacts.index'), navigate: true);
    }

    /**
     * Island Load More: append more activities
     */
    public function loadMoreActivities()
    {
        sleep(0.5); // Demo loading indicator
        $this->activityLimit += 3;
    }

    #[Computed]
    public function activities()
    {
        return $this->contact->activities()->latest()->take($this->activityLimit)->get();
    }

    #[Computed]
    public function totalActivities()
    {
        return $this->contact->activities()->count();
    }
}; ?>

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <a href="{{ route('contacts.index') }}" wire:navigate
            class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
            ← Back to Contacts
        </a>
        <h1 class="text-3xl font-bold text-zinc-900 dark:text-white mt-2">Edit: {{ $contact->name }}</h1>
    </div>

    <div class="grid grid-cols-1 gap-8">
        {{-- Edit Form --}}
        <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-sm border border-zinc-200 dark:border-zinc-700 p-6">
            <form wire:submit="update" class="space-y-6">
                {{-- Name --}}
                <div>
                    <flux:field variant="inline">
                        <flux:input wire:model.live="name" type="text" label="Full Name" />
                        <flux:error for="name" />
                    </flux:field>
                </div>

                {{-- Email --}}
                <div>
                    <flux:field variant="inline">
                        <flux:input wire:model="email" type="email" label="Email Address" />
                        <flux:error for="email" />
                    </flux:field>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Phone --}}
                    <div>
                        <flux:field variant="inline">
                            <flux:input wire:model="phone" type="text" label="Phone" />
                            <flux:error for="phone" />
                        </flux:field>
                    </div>

                    {{-- Company --}}
                    <div>
                        <flux:field variant="inline">
                            <flux:input wire:model="company" type="text" label="Company" />
                            <flux:error for="company" />
                        </flux:field>
                    </div>
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Status</label>
                    <select wire:model.live="status"
                        class="w-full rounded-md border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white px-3 py-2 text-sm">
                        <option value="lead">Lead</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                {{-- ============================================================ --}}
                {{-- FEATURE 4: OBSERVER PATTERN — status change indicator --}}
                {{-- ============================================================ --}}
                @if($statusChangeMessage)
                    <div class="p-4 bg-amber-50 dark:bg-amber-900/20 rounded-md border border-amber-200 dark:border-amber-800">
                        <p class="text-sm text-amber-700 dark:text-amber-300 font-medium">
                            👁️ Observer Pattern: {{ $statusChangeMessage }}
                        </p>
                        <p class="text-xs text-amber-500 dark:text-amber-400 mt-1">
                            The <code class="bg-amber-100 dark:bg-amber-800 px-1 rounded">updated('status')</code> hook detected the change in real-time before saving.
                        </p>
                    </div>
                @endif

                {{-- Notes --}}
                <div>
                    <flux:field variant="inline">
                        <flux:textarea wire:model="notes" label="Notes" rows="3">
                            <flux:error for="notes" />
                        </flux:textarea>
                    </flux:field>
                </div>

                {{-- ============================================================ --}}
                {{-- FEATURE 2: LOADING INDICATOR — submit button --}}
                {{-- ============================================================ --}}
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-zinc-200 dark:border-zinc-700">
                    <a href="{{ route('contacts.index') }}" wire:navigate
                        class="px-4 py-2 text-sm font-medium text-zinc-700 bg-white border border-zinc-300 rounded-md hover:bg-zinc-50 dark:bg-zinc-800 dark:text-zinc-300 dark:border-zinc-600 dark:hover:bg-zinc-700">
                        Cancel
                    </a>
                    <flux:button type="submit" variant="primary" color="indigo">
                        <span wire:loading.remove wire:target="update">Update Contact</span>
                        <span wire:loading wire:target="update">Updating...</span>
                    </flux:button>
                </div>
            </form>
        </div>

        {{-- ============================================================ --}}
        {{-- FEATURE 3: NESTED ISLANDS — Activity History with Load More --}}
        {{-- ============================================================ --}}
        <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-sm border border-zinc-200 dark:border-zinc-700 p-6">
            <h3 class="text-lg font-bold text-zinc-900 dark:text-white mb-4">
                Activity History
                <span class="text-sm font-normal text-zinc-500">(Island with Load More)</span>
            </h3>

            @island(name: 'activities')
                <div class="space-y-3 mb-4">
                    @forelse($this->activities as $activity)
                        <div wire:key="activity-{{ $activity->id }}"
                             class="flex items-start gap-3 p-3 bg-zinc-50 dark:bg-zinc-900 rounded-lg border border-zinc-100 dark:border-zinc-800">
                            @php
                                $icons = ['created' => '🆕', 'updated' => '✏️', 'emailed' => '📧', 'called' => '📞', 'note_added' => '📝', 'status_changed' => '🔄'];
                            @endphp
                            <div class="text-lg">{{ $icons[$activity->type] ?? '📋' }}</div>
                            <div class="flex-1">
                                <p class="text-sm text-zinc-800 dark:text-zinc-200">{{ $activity->description }}</p>
                                <p class="text-xs text-zinc-500 mt-0.5">{{ $activity->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-zinc-500 text-center py-4">No activity recorded yet.</p>
                    @endforelse
                </div>

                {{-- Nested Island: Activity count --}}
                @island(name: 'activity-count')
                    <p class="text-xs text-zinc-400 mb-3">
                        Showing {{ min($activityLimit, $this->totalActivities) }} of {{ $this->totalActivities }} activities
                    </p>
                @endisland
            @endisland

            @if($this->totalActivities > $activityLimit)
                <button wire:click="loadMoreActivities"
                    class="w-full py-2 bg-zinc-100 dark:bg-zinc-700 text-zinc-600 dark:text-zinc-300 text-sm font-medium rounded-md hover:bg-zinc-200 dark:hover:bg-zinc-600 transition">
                    <span wire:loading.remove wire:target="loadMoreActivities">Load More Activities</span>
                    <span wire:loading wire:target="loadMoreActivities">Loading...</span>
                </button>
            @endif
        </div>
    </div>

    {{-- Feature Explanations --}}
    <div class="mt-8 space-y-4">
        <h2 class="text-xl font-bold text-zinc-900 dark:text-white mb-4">🧪 Livewire 4 Features on This Page</h2>

        <details class="bg-gradient-to-r from-blue-50 to-cyan-50 dark:from-blue-900/20 dark:to-cyan-900/20 rounded-lg border border-blue-200 dark:border-blue-800 p-4">
            <summary class="font-semibold text-blue-900 dark:text-blue-100 cursor-pointer">🏝️ Feature: Nested Islands (Load More)</summary>
            <div class="mt-3 text-sm text-blue-800 dark:text-blue-200 space-y-2">
                <p><strong>What:</strong> The activity history section is wrapped in <code>@island(name: 'activities')</code>. Inside that, there's a nested <code>@island(name: 'activity-count')</code> for the "Showing X of Y" counter.</p>
                <p><strong>Where on this page:</strong> The "Activity History" section below the form.</p>
                <p><strong>How to test:</strong></p>
                <ol class="list-decimal list-inside space-y-1 ml-2">
                    <li>If there are more than 3 activities, a "Load More Activities" button appears</li>
                    <li>Click it → the button shows "Loading..." (loading indicator) and more activities appear</li>
                    <li>The "Showing X of Y" counter updates (nested island re-render)</li>
                    <li>Open DevTools → Elements → search <code>data-island</code> to see nested structure</li>
                </ol>
            </div>
        </details>

        <details class="bg-gradient-to-r from-purple-50 to-violet-50 dark:from-purple-900/20 dark:to-violet-900/20 rounded-lg border border-purple-200 dark:border-purple-800 p-4">
            <summary class="font-semibold text-purple-900 dark:text-purple-100 cursor-pointer">👁️ Feature: Observer Pattern (Status Change)</summary>
            <div class="mt-3 text-sm text-purple-800 dark:text-purple-200 space-y-2">
                <p><strong>What:</strong> The <code>updated('status')</code> hook detects when you change the status dropdown. It shows a real-time message indicating the change <strong>before saving</strong>.</p>
                <p><strong>How to test:</strong></p>
                <ol class="list-decimal list-inside space-y-1 ml-2">
                    <li>Change the Status dropdown from its current value to a different one</li>
                    <li>An amber banner appears: "Status changing from X → Y"</li>
                    <li>Change it back to the original → the banner disappears</li>
                    <li>Click "Update Contact" → a status_changed activity is logged</li>
                </ol>
            </div>
        </details>

        <details class="bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/20 dark:to-green-900/20 rounded-lg border border-emerald-200 dark:border-emerald-800 p-4">
            <summary class="font-semibold text-emerald-900 dark:text-emerald-100 cursor-pointer">⏳ Feature: Loading Indicators</summary>
            <div class="mt-3 text-sm text-emerald-800 dark:text-emerald-200 space-y-2">
                <p><strong>Where on this page:</strong> Two places: the "Update Contact" button (text → "Updating...") and the "Load More Activities" button (text → "Loading...").</p>
                <p><strong>How to test:</strong> Click either button and watch the text swap + opacity change.</p>
            </div>
        </details>
    </div>
</div>
