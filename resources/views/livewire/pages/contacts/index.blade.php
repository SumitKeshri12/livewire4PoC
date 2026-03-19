<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use App\Models\Contact;

new #[Layout('layouts.app'), Title('Contacts - Livewire 4 Features Demo')] class extends Component {
    public string $search = '';
    public string $statusFilter = '';

    public function deleteContact($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->activities()->delete();
        $contact->delete();

        // Observer Pattern: notify other parts of the page
        $this->dispatch('contactDeleted');
        $this->dispatch('show-toast', type: 'success', message: "{$contact->name} deleted successfully");
    }

    public function refreshStats()
    {
        sleep(1); // Simulate network delay to demo Smart Loading Indicators
    }

    #[Computed]
    public function contacts()
    {
        return Contact::query()
            ->when($this->search, fn($q) => $q->search($this->search))
            ->when($this->statusFilter, fn($q) => $q->where('status', $this->statusFilter))
            ->latest()
            ->paginate(10);
    }

    #[Computed]
    public function totalContacts()
    {
        return Contact::count();
    }

    #[Computed]
    public function activeContacts()
    {
        return Contact::where('status', 'active')->count();
    }

    #[Computed]
    public function leadContacts()
    {
        return Contact::where('status', 'lead')->count();
    }
}; ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- ============================================================ --}}
    {{-- FEATURE 1: BASIC + NESTED ISLANDS --}}
    {{-- Stats cards wrapped in @island — they re-render independently --}}
    {{-- ============================================================ --}}
    @island(name: 'stats')
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white dark:bg-zinc-800 rounded-lg p-6 border border-zinc-200 dark:border-zinc-700 shadow-sm">
                <h3 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Total Contacts</h3>
                <p class="text-2xl font-bold text-zinc-900 dark:text-white mt-1">{{ $this->totalContacts }}</p>

                {{-- NESTED ISLAND: Updates independently inside the parent island --}}
                @island(name: 'last-refreshed')
                    <p class="text-xs text-zinc-400 mt-2">Refreshed: {{ now()->format('H:i:s') }}</p>
                @endisland
            </div>

            <div class="bg-white dark:bg-zinc-800 rounded-lg p-6 border border-zinc-200 dark:border-zinc-700 shadow-sm">
                <h3 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Active</h3>
                <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400 mt-1">{{ $this->activeContacts }}</p>
            </div>

            <div class="bg-white dark:bg-zinc-800 rounded-lg p-6 border border-zinc-200 dark:border-zinc-700 shadow-sm">
                <h3 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Leads</h3>
                <p class="text-2xl font-bold text-amber-600 dark:text-amber-400 mt-1">{{ $this->leadContacts }}</p>
            </div>

            <div class="bg-white dark:bg-zinc-800 rounded-lg p-6 border border-zinc-200 dark:border-zinc-700 shadow-sm flex items-center justify-center">
                {{-- ============================================================ --}}
                {{-- FEATURE 2: LOADING INDICATOR --}}
                {{-- This button auto-gets [data-loading] during the request --}}
                {{-- ============================================================ --}}
                <flux:button variant="primary" color="indigo" wire:click="refreshStats">
                    <span wire:loading.remove wire:target="refreshStats">Refresh Stats</span>
                    <span wire:loading wire:target="refreshStats">Refreshing...</span>
                </flux:button>
            </div>
        </div>
    @endisland

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Contacts</h1>
        <a href="{{ route('contacts.create') }}" wire:navigate
            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition text-sm font-medium">
            + New Contact
        </a>
    </div>

    {{-- Search & Filter --}}
    <div class="flex flex-col sm:flex-row gap-4 mb-6">
        <div class="flex-1">
            <flux:input wire:model.live.debounce.300ms="search" type="text" placeholder="Search by name, email, or company..." />
        </div>
        <div class="w-full sm:w-48">
            <select wire:model.live="statusFilter"
                class="w-full rounded-md border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white px-3 py-2 text-sm">
                <option value="">All Statuses</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="lead">Lead</option>
            </select>
        </div>
    </div>

    {{-- Contacts Table --}}
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
        <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
            <thead class="bg-zinc-50 dark:bg-zinc-900">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Company</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                @forelse($this->contacts as $contact)
                    <tr wire:key="contact-{{ $contact->id }}" class="hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-zinc-900 dark:text-white">{{ $contact->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-600 dark:text-zinc-400">{{ $contact->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-600 dark:text-zinc-400">{{ $contact->company ?? '—' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $colors = ['active' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400', 'inactive' => 'bg-zinc-100 text-zinc-800 dark:bg-zinc-700 dark:text-zinc-300', 'lead' => 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400'];
                            @endphp
                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $colors[$contact->status] ?? '' }}">
                                {{ ucfirst($contact->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm space-x-2">
                            <a href="{{ route('contacts.show', $contact) }}" wire:navigate class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium">View</a>
                            <a href="{{ route('contacts.edit', $contact) }}" wire:navigate class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium">Edit</a>
                            <button @click="$dispatch('confirm-delete-contact', { id: {{ $contact->id }}, name: '{{ addslashes($contact->name) }}' })" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 font-medium">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-sm text-zinc-500 dark:text-zinc-400">
                            No contacts found. <a href="{{ route('contacts.create') }}" wire:navigate class="text-indigo-600 hover:underline">Create one</a>.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($this->contacts->hasPages())
            <div class="px-6 py-4 border-t border-zinc-200 dark:border-zinc-700">
                {{ $this->contacts->links() }}
            </div>
        @endif
    </div>

    {{-- Delete Confirmation Modal --}}
    <div x-data="{ open: false, id: null, name: '' }"
         x-on:confirm-delete-contact.window="open = true; id = $event.detail.id; name = $event.detail.name"
         x-show="open" style="display: none;"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-2xl p-6 max-w-sm w-full mx-4" @click.outside="open = false">
            <h3 class="text-lg font-bold text-red-600 mb-2">Delete Contact?</h3>
            <p class="text-zinc-600 dark:text-zinc-400 mb-6">
                Are you sure you want to delete <strong x-text="name"></strong>? This action cannot be undone.
            </p>
            <div class="flex justify-end gap-3">
                <button @click="open = false" class="px-4 py-2 text-zinc-600 dark:text-zinc-300 font-medium hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-md">Cancel</button>
                <button @click="$wire.deleteContact(id); open = false" class="px-4 py-2 bg-red-600 text-white font-medium hover:bg-red-700 rounded-md">
                    <span wire:loading.remove wire:target="deleteContact">Delete</span>
                    <span wire:loading wire:target="deleteContact">Deleting...</span>
                </button>
            </div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- FEATURE EXPLANATION PANELS --}}
    {{-- ============================================================ --}}
    <div class="mt-12 space-y-4">
        <h2 class="text-xl font-bold text-zinc-900 dark:text-white mb-4">🧪 Livewire 4 Features on This Page</h2>

        <details class="bg-gradient-to-r from-blue-50 to-cyan-50 dark:from-blue-900/20 dark:to-cyan-900/20 rounded-lg border border-blue-200 dark:border-blue-800 p-4">
            <summary class="font-semibold text-blue-900 dark:text-blue-100 cursor-pointer">🏝️ Feature: Basic + Nested Islands</summary>
            <div class="mt-3 text-sm text-blue-800 dark:text-blue-200 space-y-2">
                <p><strong>What:</strong> Islands let you isolate parts of your view so they re-render independently, without triggering a full page re-render.</p>
                <p><strong>Where on this page:</strong> The stats cards at the top are wrapped in <code>@island(name: 'stats')</code>. Inside the "Total Contacts" card, the "Refreshed: HH:MM:SS" timestamp is a <strong>nested</strong> island (<code>@island(name: 'last-refreshed')</code>).</p>
                <p><strong>How to test:</strong></p>
                <ol class="list-decimal list-inside space-y-1 ml-2">
                    <li>Open DevTools → Elements tab</li>
                    <li>Search for <code>data-island</code> attributes — you'll see them on the stats section and the nested timestamp</li>
                    <li>Click "Refresh Stats" — only the island re-renders, not the entire table</li>
                    <li>Notice the timestamp updates independently inside the parent island</li>
                </ol>
            </div>
        </details>

        <details class="bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/20 dark:to-green-900/20 rounded-lg border border-emerald-200 dark:border-emerald-800 p-4">
            <summary class="font-semibold text-emerald-900 dark:text-emerald-100 cursor-pointer">⏳ Feature: Loading Indicators</summary>
            <div class="mt-3 text-sm text-emerald-800 dark:text-emerald-200 space-y-2">
                <p><strong>What:</strong> Livewire 4 automatically adds a <code>data-loading</code> attribute to elements that triggered a request. CSS handles the visual feedback (opacity, spinner).</p>
                <p><strong>Where on this page:</strong> The "Refresh Stats" button (has 1-second delay) and the Delete button in the modal.</p>
                <p><strong>How to test:</strong></p>
                <ol class="list-decimal list-inside space-y-1 ml-2">
                    <li>Click "Refresh Stats" button → text changes to "Refreshing...", button gets semi-transparent with a spinner</li>
                    <li>Open DevTools → watch <code>data-loading</code> attribute appear/disappear on the button during the request</li>
                    <li>Delete a contact → the Delete button text changes to "Deleting..."</li>
                </ol>
            </div>
        </details>

        <details class="bg-gradient-to-r from-purple-50 to-violet-50 dark:from-purple-900/20 dark:to-violet-900/20 rounded-lg border border-purple-200 dark:border-purple-800 p-4">
            <summary class="font-semibold text-purple-900 dark:text-purple-100 cursor-pointer">👁️ Feature: Observer Pattern</summary>
            <div class="mt-3 text-sm text-purple-800 dark:text-purple-200 space-y-2">
                <p><strong>What:</strong> Components communicate by dispatching events. When a contact is deleted, a <code>contactDeleted</code> event is dispatched, and the stats island reacts by re-rendering with updated counts.</p>
                <p><strong>Where on this page:</strong> Delete a contact → stats cards update automatically (total count decreases).</p>
                <p><strong>How to test:</strong></p>
                <ol class="list-decimal list-inside space-y-1 ml-2">
                    <li>Note the current "Total Contacts" count</li>
                    <li>Delete a contact using the Delete button</li>
                    <li>Watch the stats cards update — the count should decrease by 1</li>
                    <li>The toast notification also appears (another observer listening to the same event lifecycle)</li>
                </ol>
            </div>
        </details>
    </div>
</div>
