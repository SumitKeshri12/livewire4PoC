<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\User;

new #[Layout('layouts.app'), Title('Request Interceptors - LiveWire 4')] class extends Component {
    public array $logs = [];

    public function refresh()
    {
        sleep(1); // Simulate network delay
        $this->logs[] = 'Refresh action completed at ' . now()->format('H:i:s');
    }

    public function invalidateSession()
    {
        session()->regenerateToken();
        $this->logs[] = 'Session token regenerated';
    }

    public function trigger404()
    {
        // This will throw a ModelNotFoundException which Laravel converts to 404
        User::findOrFail(999999);
    }

    public function triggerRedirect()
    {
        return redirect('/dashboard');
    }

    public function cancelableAction()
    {
        $this->logs[] = 'This action was NOT canceled!';
    }
}; ?>

<div class="p-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-zinc-900 dark:text-white mb-2">Request Interceptors</h1>
            <p class="text-zinc-600 dark:text-zinc-400 mb-4">
                Hook into LiveWire's HTTP requests to add custom behavior like logging, error handling, and analytics.
            </p>
        </div>

        <!-- What Are Request Interceptors? -->
        <div
            class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-lg border border-blue-200 dark:border-blue-800 p-6 mb-8">
            <h2 class="text-xl font-semibold text-blue-900 dark:text-blue-100 mb-3">💡 What Are Request Interceptors?
            </h2>

            <p class="text-sm text-blue-800 dark:text-blue-200 mb-4">
                Request Interceptors let you "listen" to LiveWire's HTTP requests and responses. Think of them as
                middleware for your frontend -
                they run automatically whenever LiveWire communicates with your server.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white dark:bg-blue-900/30 rounded-lg p-4">
                    <h3 class="text-sm font-bold text-blue-900 dark:text-blue-100 mb-2">🎯 Common Use Cases</h3>
                    <ul class="text-xs text-blue-700 dark:text-blue-300 space-y-1">
                        <li>• Log all API calls for debugging</li>
                        <li>• Show custom error messages (404, 500, etc.)</li>
                        <li>• Handle session expiration (419 errors)</li>
                        <li>• Track analytics and user behavior</li>
                        <li>• Add loading indicators globally</li>
                        <li>• Modify requests before sending</li>
                    </ul>
                </div>

                <div class="bg-white dark:bg-blue-900/30 rounded-lg p-4">
                    <h3 class="text-sm font-bold text-blue-900 dark:text-blue-100 mb-2">🔄 How It Works</h3>
                    <ol class="text-xs text-blue-700 dark:text-blue-300 space-y-1">
                        <li>1️⃣ User clicks a button (e.g., "Save")</li>
                        <li>2️⃣ LiveWire prepares HTTP request</li>
                        <li>3️⃣ <strong>Your interceptor runs BEFORE sending</strong></li>
                        <li>4️⃣ Request goes to server</li>
                        <li>5️⃣ Server responds</li>
                        <li>6️⃣ <strong>Your interceptor runs AFTER receiving</strong></li>
                        <li>7️⃣ Page updates with new data</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Feature Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Global Interceptors -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
                <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-4">Global Interceptors</h2>

                <div class="space-y-4">
                    <div>
                        <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">onSend & onResponse</h3>
                        <flux:button wire:click="refresh" variant="primary" icon="arrow-path" color="green">
                            Send Request
                        </flux:button>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-2">
                            Check browser console for "sent" and "received" logs
                        </p>
                    </div>

                    <div class="border-t border-zinc-200 dark:border-zinc-700 pt-4">
                        <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">onError (419 Session
                            Expired)</h3>
                        <div class="flex gap-2">
                            <flux:button wire:click="invalidateSession" variant="danger" icon="key" color="red">
                                Invalidate Session
                            </flux:button>
                            <flux:button wire:click="refresh" variant="primary" icon="arrow-path" color="green">
                                Trigger Action
                            </flux:button>
                        </div>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-2">
                            First invalidate session, then trigger action to see custom 419 handler
                        </p>
                    </div>

                    <div class="border-t border-zinc-200 dark:border-zinc-700 pt-4">
                        <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">onError (404 Not Found)
                        </h3>
                        <flux:button wire:click="trigger404" variant="danger" icon="x-circle" color="red">
                            Trigger 404
                        </flux:button>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-2">
                            Custom alert will show instead of default error
                        </p>
                    </div>

                    <div class="border-t border-zinc-200 dark:border-zinc-700 pt-4">
                        <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">onRedirect</h3>
                        <flux:button wire:click="triggerRedirect" variant="primary" icon="arrow-right" color="green">
                            Trigger Redirect
                        </flux:button>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-2">
                            Redirect will be intercepted and shown in alert
                        </p>
                    </div>
                </div>
            </div>

            <!-- Component-Level Interceptors -->
            <div x-data="interceptorDemo"
                class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
                <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-4">Component-Level Interceptors</h2>

                <div class="space-y-4">
                    <div>
                        <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Action Interception</h3>
                        <flux:button wire:click="cancelableAction" id="cancelable-button" variant="primary"
                            icon="x-mark" color="red">
                            Cancelable Action
                        </flux:button>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-2">
                            This action is intercepted and canceled - check console
                        </p>
                    </div>

                    <div class="border-t border-zinc-200 dark:border-zinc-700 pt-4">
                        <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-3">Activity Logs</h3>
                        <div class="bg-zinc-50 dark:bg-zinc-900 rounded-lg p-4 max-h-48 overflow-y-auto">
                            @if (count($logs) > 0)
                                <ul class="space-y-1">
                                    @foreach ($logs as $log)
                                        <li class="text-xs text-zinc-600 dark:text-zinc-400 font-mono">
                                            {{ $log }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-xs text-zinc-400 dark:text-zinc-500 italic">No activity yet...</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Code Examples -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-4">Code Examples</h2>

            <div class="space-y-6">
                <!-- Global Interceptor Example -->
                <div>
                    <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Global Request Interceptor
                    </h3>
                    <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs">
                        <code>
                            document.addEventListener('livewire:init', () => {
                                Livewire.hook('request', ({ respond, succeed, fail }) => {
                                    // Runs before request is sent
                                    console.log('sent');
                                    
                                    respond(({ status, response }) => {
                                    // Runs when response is received
                                    console.log('received', response);
                                    });
                                });
                                
                                succeed(({ status, json }) => {
                                    // Runs on successful response
                                    console.log('success', json);
                                });
                                
                                fail(({ status, content, preventDefault }) => {
                                    // Handle errors
                                    if (status === 419) {
                                        preventDefault();
                                        alert('Session expired!');
                                    }
                                    if (status === 404) {
                                        preventDefault();
                                        alert('Resource not found!');
                                    }
                                });
                            });
                        </code>
                    </pre>
                </div>

                <!-- Component-Level Interceptor Example -->
                <div>
                    <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Component-Level Action
                        Interception</h3>
                    <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs">
                        <code>
                            // Inside an Alpine.js component
                            Alpine.data('myComponent', () => ({
                                init() {
                                    this.$wire.intercept('cancelableAction', (action) => {
                                        console.log('Action intercepted:', action);
                                        action.cancel(); // Cancel the action
                                    });
                                }
                            }));
                        </code>
                    </pre>
                </div>
            </div>
        </div>
    </div>
</div>

@assets
    <script>
        document.addEventListener('livewire:init', (event) => {
            Livewire.interceptRequest(({
                onResponse,
                onRedirect,
                onError
            }) => {
                console.log('🚀 Request sent');

                onResponse(() => console.log('✅ Response received'));

                onRedirect(({
                    url,
                    preventDefault
                }) => {
                    preventDefault();
                    alert('Redirecting to: ' + url);
                });

                onError(({
                    response,
                    preventDefault
                }) => {
                    preventDefault();
                    alert('Error: ' + response);
                })
            });

            Alpine.data('interceptorDemo', () => ({
                init() {
                    // Determine if $wire.intercept exists, otherwise fallback or log
                    if (this.$wire && this.$wire.intercept) {
                        this.$wire.intercept('cancelableAction', (action) => {
                            console.log('🛑 Action intercepted:', action);
                            action.cancel();
                            alert('🛑 Action "cancelableAction" was intercepted and canceled!');
                        });
                    } else {
                        console.warn('$wire.intercept is not available in this Livewire version.');
                    }
                }
            }));
        });
    </script>
@endassets
