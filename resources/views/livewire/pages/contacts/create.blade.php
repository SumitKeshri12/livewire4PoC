<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use App\Models\Contact;
use App\Models\ContactActivity;

new #[Layout('layouts.app'), Title('Create Contact')] class extends Component {
    #[Rule('required|string|min:2|max:255')]
    public string $name = '';

    #[Rule('required|email|unique:contacts,email')]
    public string $email = '';

    #[Rule('nullable|string|max:20')]
    public string $phone = '';

    #[Rule('nullable|string|max:255')]
    public string $company = '';

    #[Rule('required|in:active,inactive,lead')]
    public string $status = 'lead';

    #[Rule('nullable|string')]
    public string $notes = '';

    // Observer Pattern: auto-detected company from email domain
    public string $detectedCompany = '';
    public array $requestLogs = [];

    /**
     * Observer Pattern: React to property changes
     * When the email changes, auto-detect the company domain
     */
    public function updated($property)
    {
        if ($property === 'email' && str_contains($this->email, '@')) {
            $domain = explode('@', $this->email)[1] ?? '';
            $domainName = explode('.', $domain)[0] ?? '';

            if ($domainName && !in_array($domainName, ['gmail', 'yahoo', 'hotmail', 'outlook', 'protonmail', 'icloud'])) {
                $this->detectedCompany = ucfirst($domainName);

                // Auto-fill company if empty
                if (empty($this->company)) {
                    $this->company = $this->detectedCompany;
                }
            } else {
                $this->detectedCompany = '';
            }
        }
    }

    public function store()
    {
        $validated = $this->validate();

        $contact = Contact::create($validated);

        // Log the creation activity
        ContactActivity::create([
            'contact_id' => $contact->id,
            'type' => 'created',
            'description' => "Contact '{$contact->name}' was created",
        ]);

        // Observer Pattern: dispatch event for any listening components
        $this->dispatch('contactCreated');
        $this->dispatch('show-toast', type: 'success', message: "Contact '{$contact->name}' created successfully!");

        $this->redirect(route('contacts.index'), navigate: true);
    }
}; ?>

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <a href="{{ route('contacts.index') }}" wire:navigate
            class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
            ← Back to Contacts
        </a>
        <h1 class="text-3xl font-bold text-zinc-900 dark:text-white mt-2">Create Contact</h1>
    </div>

    <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-sm border border-zinc-200 dark:border-zinc-700 p-6">
        <form wire:submit="store" class="space-y-6">
            {{-- Name --}}
            <div>
                <flux:field variant="inline">
                    <flux:input wire:model.live="name" type="text" label="Full Name" placeholder="e.g. John Doe" />
                    <flux:error for="name" />
                </flux:field>
            </div>

            {{-- Email --}}
            <div>
                <flux:field variant="inline">
                    <flux:input wire:model.live.debounce.500ms="email" type="email" label="Email Address" placeholder="e.g. john@company.com" />
                    <flux:error for="email" />
                </flux:field>
            </div>

            {{-- ============================================================ --}}
            {{-- FEATURE 4: OBSERVER PATTERN --}}
            {{-- Auto-detected company from email domain --}}
            {{-- ============================================================ --}}
            @if($detectedCompany)
                <div class="p-4 bg-indigo-50 dark:bg-indigo-900/20 rounded-md border border-indigo-100 dark:border-indigo-800 animate-pulse-once">
                    <p class="text-sm text-indigo-700 dark:text-indigo-300 font-medium">
                        🔍 Observer Pattern: Detected company from email domain →
                        <span class="text-lg font-bold ml-1">{{ $detectedCompany }}</span>
                    </p>
                    <p class="text-xs text-indigo-500 dark:text-indigo-400 mt-1">
                        The <code class="bg-indigo-100 dark:bg-indigo-800 px-1 rounded">updated('email')</code> lifecycle hook parsed the domain and auto-filled the Company field.
                    </p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Phone --}}
                <div>
                    <flux:field variant="inline">
                        <flux:input wire:model="phone" type="text" label="Phone" placeholder="+1-555-0100" />
                        <flux:error for="phone" />
                    </flux:field>
                </div>

                {{-- Company --}}
                <div>
                    <flux:field variant="inline">
                        <flux:input wire:model.live="company" type="text" label="Company" placeholder="Company name" />
                        <flux:error for="company" />
                    </flux:field>
                </div>
            </div>

            {{-- Status --}}
            <div>
                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Status</label>
                <select wire:model="status"
                    class="w-full rounded-md border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white px-3 py-2 text-sm">
                    <option value="lead">Lead</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Notes --}}
            <div>
                <flux:field variant="inline">
                    <flux:textarea wire:model="notes" label="Notes" rows="3" placeholder="Any additional notes...">
                        <flux:error for="notes" />
                    </flux:textarea>
                </flux:field>
            </div>

            {{-- ============================================================ --}}
            {{-- FEATURE 2: LOADING INDICATOR --}}
            {{-- Submit button with wire:loading text swap --}}
            {{-- ============================================================ --}}
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-zinc-200 dark:border-zinc-700">
                <a href="{{ route('contacts.index') }}" wire:navigate
                    class="px-4 py-2 text-sm font-medium text-zinc-700 bg-white border border-zinc-300 rounded-md hover:bg-zinc-50 dark:bg-zinc-800 dark:text-zinc-300 dark:border-zinc-600 dark:hover:bg-zinc-700">
                    Cancel
                </a>
                <flux:button type="submit" variant="primary" color="indigo">
                    <span wire:loading.remove wire:target="store">Create Contact</span>
                    <span wire:loading wire:target="store">Saving...</span>
                </flux:button>
            </div>
        </form>
    </div>

    {{-- ============================================================ --}}
    {{-- FEATURE 1: REQUEST INTERCEPTOR --}}
    {{-- Visible request activity log powered by JS interceptor --}}
    {{-- ============================================================ --}}
    <div class="mt-8 bg-white dark:bg-zinc-800 rounded-lg shadow-sm border border-zinc-200 dark:border-zinc-700 p-6">
        <h3 class="text-lg font-bold text-zinc-900 dark:text-white mb-3">🔌 Request Interceptor Activity Log</h3>
        <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-4">
            Every Livewire request on this page is intercepted by a JavaScript hook. The log below shows real-time request/response lifecycle events.
        </p>
        <div id="interceptor-log" class="bg-zinc-900 text-zinc-100 p-4 rounded-lg max-h-48 overflow-y-auto font-mono text-xs space-y-1">
            <p class="text-zinc-500 italic">Waiting for Livewire requests...</p>
        </div>
    </div>

    {{-- Feature Explanations --}}
    <div class="mt-8 space-y-4">
        <h2 class="text-xl font-bold text-zinc-900 dark:text-white mb-4">🧪 Livewire 4 Features on This Page</h2>

        <details class="bg-gradient-to-r from-orange-50 to-amber-50 dark:from-orange-900/20 dark:to-amber-900/20 rounded-lg border border-orange-200 dark:border-orange-800 p-4">
            <summary class="font-semibold text-orange-900 dark:text-orange-100 cursor-pointer">🔌 Feature: Request Interceptors</summary>
            <div class="mt-3 text-sm text-orange-800 dark:text-orange-200 space-y-2">
                <p><strong>What:</strong> Request Interceptors let you hook into Livewire's HTTP request lifecycle via JavaScript. You can intercept before sending, after receiving, on error, and on redirect.</p>
                <p><strong>Where on this page:</strong> The "Request Interceptor Activity Log" panel at the bottom shows every request/response in real-time. The JavaScript <code>Livewire.hook('request', ...)</code> runs automatically.</p>
                <p><strong>How to test:</strong></p>
                <ol class="list-decimal list-inside space-y-1 ml-2">
                    <li>Type in the Name field → watch the activity log populate with "🚀 Request sent" and "✅ Response received"</li>
                    <li>Open browser DevTools → Console → you'll see matching console.log entries</li>
                    <li>Submit with invalid data → the interceptor logs the validation error response</li>
                    <li>The interceptor recorded timing: compare "sent at" and "received at" for latency</li>
                </ol>
            </div>
        </details>

        <details class="bg-gradient-to-r from-purple-50 to-violet-50 dark:from-purple-900/20 dark:to-violet-900/20 rounded-lg border border-purple-200 dark:border-purple-800 p-4">
            <summary class="font-semibold text-purple-900 dark:text-purple-100 cursor-pointer">👁️ Feature: Observer Pattern</summary>
            <div class="mt-3 text-sm text-purple-800 dark:text-purple-200 space-y-2">
                <p><strong>What:</strong> The <code>updated()</code> lifecycle hook reacts to property changes. When a property changes, the observer method fires automatically — this is the server-side observer.</p>
                <p><strong>Where on this page:</strong> Type an email like <code>john@google.com</code>. The <code>updated('email')</code> hook parses the domain, detects "Google" as the company, and auto-fills the Company field.</p>
                <p><strong>How to test:</strong></p>
                <ol class="list-decimal list-inside space-y-1 ml-2">
                    <li>Type <code>alice@microsoft.com</code> in the email field</li>
                    <li>Watch the blue "Observer Pattern" box appear with "Detected: Microsoft"</li>
                    <li>The Company field auto-fills with "Microsoft"</li>
                    <li>Now try <code>bob@gmail.com</code> — no detection (personal email domains are excluded)</li>
                </ol>
            </div>
        </details>

        <details class="bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/20 dark:to-green-900/20 rounded-lg border border-emerald-200 dark:border-emerald-800 p-4">
            <summary class="font-semibold text-emerald-900 dark:text-emerald-100 cursor-pointer">⏳ Feature: Loading Indicators</summary>
            <div class="mt-3 text-sm text-emerald-800 dark:text-emerald-200 space-y-2">
                <p><strong>What:</strong> <code>wire:loading</code> / <code>wire:loading.remove</code> toggle element visibility during requests. The <code>data-loading</code> CSS handles automatic opacity + spinner.</p>
                <p><strong>Where on this page:</strong> The "Create Contact" submit button changes to "Saving..." during form submission.</p>
                <p><strong>How to test:</strong></p>
                <ol class="list-decimal list-inside space-y-1 ml-2">
                    <li>Fill out all required fields with valid data</li>
                    <li>Click "Create Contact" → button text immediately changes to "Saving..."</li>
                    <li>Button becomes semi-transparent and unclickable (prevents double-submit)</li>
                </ol>
            </div>
        </details>
    </div>
</div>

@assets
<script>
    document.addEventListener('livewire:init', () => {
        const logEl = document.getElementById('interceptor-log');
        let requestCount = 0;

        function addLog(emoji, message, color = 'text-zinc-300') {
            if (!logEl) return;
            const time = new Date().toLocaleTimeString('en-US', {hour12: false, hour: '2-digit', minute: '2-digit', second: '2-digit', fractionalSecondDigits: 3});

            // Remove placeholder
            const placeholder = logEl.querySelector('.italic');
            if (placeholder) placeholder.remove();

            const line = document.createElement('p');
            line.className = color;
            line.textContent = `[${time}] ${emoji} ${message}`;
            logEl.appendChild(line);
            logEl.scrollTop = logEl.scrollHeight;
        }

        Livewire.hook('request', ({ respond, succeed, fail }) => {
            requestCount++;
            const reqId = requestCount;
            addLog('🚀', `Request #${reqId} sent`, 'text-cyan-400');
            console.log(`🚀 Request #${reqId} sent`);

            respond(({ status }) => {
                addLog('✅', `Request #${reqId} received (HTTP ${status})`, 'text-emerald-400');
                console.log(`✅ Request #${reqId} received (HTTP ${status})`);
            });

            succeed(({ status }) => {
                addLog('🎉', `Request #${reqId} succeeded`, 'text-green-400');
            });

            fail(({ status, preventDefault }) => {
                addLog('❌', `Request #${reqId} failed (HTTP ${status})`, 'text-red-400');
                console.error(`❌ Request #${reqId} failed (HTTP ${status})`);
            });
        });
    });
</script>
@endassets
