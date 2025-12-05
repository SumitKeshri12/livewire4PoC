<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <div
                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold mb-4">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                    <path fill-rule="evenodd"
                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                        clip-rule="evenodd" />
                </svg>
                Design Pattern Demo
            </div>
            <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl mb-4">
                Observer Pattern in Livewire
            </h1>
            <p class="mt-3 max-w-3xl mx-auto text-xl text-gray-600">
                A real-time demonstration of the Observer Pattern using Livewire 4's event system for decoupled
                component communication.
            </p>
        </div>

        <!-- Architecture Overview -->
        <div class="mb-12 bg-white rounded-xl shadow-lg p-8 border border-gray-200">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z">
                    </path>
                </svg>
                What is the Observer Pattern?
            </h2>
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">The Pattern</h3>
                    <p class="text-gray-600 mb-4">
                        The Observer Pattern defines a <strong>one-to-many dependency</strong> between objects. When one
                        object (the Subject) changes state, all its dependents (Observers) are notified and updated
                        automatically.
                    </p>
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                        <p class="text-sm text-blue-900">
                            <strong>Key Benefit:</strong> Loose coupling between components. The Subject doesn't need to
                            know who its Observers are—it just broadcasts events.
                        </p>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Livewire Implementation</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span><strong>Subject:</strong> Uses <code
                                    class="bg-gray-100 px-1 rounded">$this->dispatch()</code> to broadcast events</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span><strong>Observers:</strong> Use <code
                                    class="bg-gray-100 px-1 rounded">#[On('eventName')]</code> attribute to
                                listen</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span><strong>Decoupling:</strong> Components don't reference each other directly</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Interactive Demo -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                    </path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Live Demo
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- The Subject (Publisher) -->
                <div class="lg:col-span-1">
                    <livewire:observer.subject />

                    <div
                        class="mt-6 bg-gradient-to-br from-blue-50 to-indigo-50 p-5 rounded-lg border border-blue-200 shadow-sm">
                        <h4 class="font-bold mb-3 text-blue-900 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd" />
                            </svg>
                            How it works
                        </h4>
                        <ol class="list-decimal list-inside space-y-2 text-sm text-blue-900">
                            <li>Type in the Subject input field</li>
                            <li>Subject dispatches <code class="bg-blue-100 px-1 rounded">stateUpdated</code> event</li>
                            <li>All Observers receive the event</li>
                            <li>Observers update their UI automatically</li>
                        </ol>
                    </div>
                </div>

                <!-- The Observers (Subscribers) -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-gray-800">Active Observers</h3>
                        <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full">3 Listening</span>
                    </div>

                    <livewire:observer.observer name="Observer A (Logging)" />
                    <livewire:observer.observer name="Observer B (Analytics)" />
                    <livewire:observer.observer name="Observer C (Preview)" />
                </div>
            </div>
        </div>

        <!-- Code Examples -->
        <div class="mb-12 bg-white rounded-xl shadow-lg p-8 border border-gray-200">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                </svg>
                Implementation Code
            </h2>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Subject Code -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                        <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                        Subject Component
                    </h3>
                    <div class="bg-gray-900 rounded-lg p-4 overflow-x-auto">
                        <pre class="text-sm text-gray-100"><code class="language-php">class Subject extends Component
{
    public $state = '';

    public function updatedState($value)
    {
        // Broadcast to all observers
        $this->dispatch('stateUpdated', $value);
    }
}</code></pre>
                    </div>
                </div>

                <!-- Observer Code -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                        Observer Component
                    </h3>
                    <div class="bg-gray-900 rounded-lg p-4 overflow-x-auto">
                        <pre class="text-sm text-gray-100"><code class="language-php">class Observer extends Component
{
    public $observedState = '';

    #[On('stateUpdated')]
    public function updateState($newState)
    {
        // React to state change
        $this->observedState = $newState;
    }
}</code></pre>
                    </div>
                </div>
            </div>
        </div>

        <!-- Key Concepts -->
        <div class="mb-12 grid md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-blue-500">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Decoupling</h3>
                <p class="text-gray-600 text-sm">
                    Subject and Observers are independent. Add or remove observers without modifying the Subject.
                </p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-green-500">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Broadcasting</h3>
                <p class="text-gray-600 text-sm">
                    One event reaches multiple listeners simultaneously. Perfect for notifications and updates.
                </p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-purple-500">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Real-time</h3>
                <p class="text-gray-600 text-sm">
                    Livewire's reactive system ensures instant updates across all observers without page refresh.
                </p>
            </div>
        </div>

        <!-- Advanced Concepts Section -->
        <div class="mb-12">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Deep Dive: Livewire's Internal Architecture</h2>
                <p class="text-gray-600 max-w-3xl mx-auto">
                    Understanding how Livewire implements the Observer Pattern under the hood
                </p>
            </div>

            <!-- 1. Two-Way Entanglement -->
            <div class="mb-8 bg-white rounded-xl shadow-lg p-8 border border-gray-200">
                <h3 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                    </svg>
                    1. Two-Way Entanglement (JS ↔ PHP Cycle)
                </h3>
                <p class="text-gray-600 mb-6">
                    Livewire creates a fascinating back-and-forth relationship where the roles of Subject and Observer
                    swap dynamically between JavaScript and PHP.
                </p>

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-lg p-6 border-2 border-purple-200">
                        <h4 class="font-bold text-purple-900 mb-4 flex items-center gap-2">
                            <span
                                class="w-6 h-6 bg-purple-500 text-white rounded-full flex items-center justify-center text-sm">1</span>
                            Frontend → Backend Flow
                        </h4>
                        <div class="space-y-3 text-sm">
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-8 h-8 bg-purple-500 text-white rounded-lg flex items-center justify-center flex-shrink-0 font-bold">
                                    JS</div>
                                <div>
                                    <p class="font-semibold text-purple-900">User types "Hello"</p>
                                    <p class="text-purple-700 text-xs">JavaScript detects change (Subject)</p>
                                </div>
                            </div>
                            <div class="border-l-2 border-purple-300 ml-4 pl-4 space-y-2">
                                <p class="text-purple-800">↓ Proxy intercepts property change</p>
                                <p class="text-purple-800">↓ Creates snapshot of state</p>
                                <p class="text-purple-800">↓ Sends AJAX request (Notify)</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-8 h-8 bg-blue-500 text-white rounded-lg flex items-center justify-center flex-shrink-0 font-bold">
                                    PHP</div>
                                <div>
                                    <p class="font-semibold text-blue-900">Server processes request</p>
                                    <p class="text-blue-700 text-xs">PHP Component receives state (Observer)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg p-6 border-2 border-blue-200">
                        <h4 class="font-bold text-blue-900 mb-4 flex items-center gap-2">
                            <span
                                class="w-6 h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-sm">2</span>
                            Backend → Frontend Flow
                        </h4>
                        <div class="space-y-3 text-sm">
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-8 h-8 bg-blue-500 text-white rounded-lg flex items-center justify-center flex-shrink-0 font-bold">
                                    PHP</div>
                                <div>
                                    <p class="font-semibold text-blue-900">Updates state/HTML</p>
                                    <p class="text-blue-700 text-xs">Now PHP is the Subject</p>
                                </div>
                            </div>
                            <div class="border-l-2 border-blue-300 ml-4 pl-4 space-y-2">
                                <p class="text-blue-800">↓ Returns AJAX response</p>
                                <p class="text-blue-800">↓ Sends updated HTML</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-8 h-8 bg-purple-500 text-white rounded-lg flex items-center justify-center flex-shrink-0 font-bold">
                                    JS</div>
                                <div>
                                    <p class="font-semibold text-purple-900">Receives response</p>
                                    <p class="text-purple-700 text-xs">JavaScript is now Observer</p>
                                </div>
                            </div>
                            <div class="border-l-2 border-purple-300 ml-4 pl-4 space-y-2">
                                <p class="text-purple-800">↓ Updates DOM automatically</p>
                                <p class="text-purple-800">↓ Cleanup old listeners</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 bg-purple-100 border-l-4 border-purple-500 p-4 rounded-r-lg">
                    <p class="text-sm text-purple-900">
                        <strong>Key Insight:</strong> The Subject and Observer roles are <strong>not fixed</strong>.
                        They swap based on the direction of communication, creating a beautiful cyclical pattern.
                    </p>
                </div>
            </div>

            <!-- 2. Lifecycle Hooks -->
            <div class="mb-8 bg-white rounded-xl shadow-lg p-8 border border-gray-200">
                <h3 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                    2. Lifecycle Hooks (Attach/Detach/Cleanup)
                </h3>
                <p class="text-gray-600 mb-6">
                    Components have a lifecycle. The Observer Pattern needs to handle registration, deregistration, and
                    cleanup to prevent memory leaks.
                </p>

                <div class="grid md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                        <div class="flex items-center gap-2 mb-2">
                            <div
                                class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center font-bold">
                                1</div>
                            <h4 class="font-bold text-green-900">Attach (Mount)</h4>
                        </div>
                        <p class="text-sm text-green-800">Component is created and registers as an observer</p>
                    </div>
                    <div class="bg-yellow-50 rounded-lg p-4 border border-yellow-200">
                        <div class="flex items-center gap-2 mb-2">
                            <div
                                class="w-8 h-8 bg-yellow-500 text-white rounded-full flex items-center justify-center font-bold">
                                2</div>
                            <h4 class="font-bold text-yellow-900">Active</h4>
                        </div>
                        <p class="text-sm text-yellow-800">Component listens for events and updates</p>
                    </div>
                    <div class="bg-red-50 rounded-lg p-4 border border-red-200">
                        <div class="flex items-center gap-2 mb-2">
                            <div
                                class="w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center font-bold">
                                3</div>
                            <h4 class="font-bold text-red-900">Detach (Destroy)</h4>
                        </div>
                        <p class="text-sm text-red-800">Component is removed and cleanup runs</p>
                    </div>
                </div>

                <div class="bg-gray-900 rounded-lg p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                        <span class="text-gray-300 font-semibold">Lifecycle Example</span>
                    </div>
                    <pre class="text-sm text-gray-100 overflow-x-auto"><code class="language-php">class Observer extends Component
{
    public function mount()
    {
        // Component is being created
        // This is when it "attaches" as an observer
        Log::info('Observer attached');
    }

    #[On('stateUpdated')]
    public function updateState($newState)
    {
        // Active phase: responding to events
        $this->observedState = $newState;
    }

    public function destroy()
    {
        // Component is being removed
        // This is when it "detaches" and cleans up
        Log::info('Observer detached');
    }
}</code></pre>
                </div>

                <div class="mt-4 bg-green-100 border-l-4 border-green-500 p-4 rounded-r-lg">
                    <p class="text-sm text-green-900">
                        <strong>Automatic Cleanup:</strong> Livewire handles deregistration and cleanup automatically,
                        preventing "zombie listeners" and memory leaks.
                    </p>
                </div>
            </div>

            <!-- 3. Proxy Mechanism -->
            <div class="mb-8 bg-white rounded-xl shadow-lg p-8 border border-gray-200">
                <h3 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    3. Proxy Mechanism (Property Interception)
                </h3>
                <p class="text-gray-600 mb-6">
                    When you use <code class="bg-gray-100 px-2 py-1 rounded">wire:model.live</code>, Livewire uses a
                    JavaScript Proxy to intercept property changes and trigger notifications.
                </p>

                <div class="bg-gray-900 rounded-lg p-6 mb-6">
                    <div class="flex items-center gap-2 mb-3">
                        <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                        <span class="text-gray-300 font-semibold">Simplified Proxy Concept</span>
                    </div>
                    <pre class="text-sm text-gray-100 overflow-x-auto"><code class="language-javascript">// Simplified concept of how Livewire works internally
const proxy = new Proxy(component, {
    set(target, property, value) {
        // Intercept! Someone is changing a property
        console.log(`Property ${property} changed to ${value}`);
        
        // Notify observers (send AJAX request to server)
        notifyServer(property, value);
        
        return true;
    }
});

// When you type in wire:model.live="state"
// The proxy intercepts and triggers the notification
proxy.state = "Hello"; // ← This triggers the set() trap above</code></pre>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-orange-50 rounded-lg p-5 border border-orange-200">
                        <h4 class="font-bold text-orange-900 mb-3">Without Proxy (Manual)</h4>
                        <pre class="text-xs text-orange-900 bg-white p-3 rounded border border-orange-200 overflow-x-auto"><code>input.addEventListener('input', (e) => {
    // Manually detect change
    const value = e.target.value;
    
    // Manually send to server
    fetch('/update', {
        body: JSON.stringify({value})
    });
    
    // Manually update other elements
    updateObserver1(value);
    updateObserver2(value);
    updateObserver3(value);
});</code></pre>
                    </div>
                    <div class="bg-green-50 rounded-lg p-5 border border-green-200">
                        <h4 class="font-bold text-green-900 mb-3">With Proxy (Livewire)</h4>
                        <pre class="text-xs text-green-900 bg-white p-3 rounded border border-green-200 overflow-x-auto"><code>&lt;input wire:model.live="state"&gt;

// That's it! Livewire's proxy:
// ✅ Detects changes automatically
// ✅ Sends AJAX automatically
// ✅ Updates all observers automatically
// ✅ Handles cleanup automatically</code></pre>
                    </div>
                </div>
            </div>

            <!-- 4. How wire:model.live Works -->
            <div class="mb-8 bg-white rounded-xl shadow-lg p-8 border border-gray-200">
                <h3 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    4. How <code class="bg-gray-100 px-2 py-1 rounded text-cyan-700">wire:model.live</code> Works
                </h3>
                <p class="text-gray-600 mb-6">
                    Understanding the complete flow from user input to observer updates. This is where all the concepts
                    come together!
                </p>

                <div class="bg-gradient-to-br from-cyan-50 to-blue-50 rounded-lg p-6 border-2 border-cyan-200 mb-6">
                    <h4 class="font-bold text-cyan-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd" />
                        </svg>
                        The Code in Our Demo
                    </h4>
                    <div class="bg-white rounded-lg p-4 border border-cyan-300">
                        <pre class="text-sm text-cyan-900"><code>&lt;input wire:model.live="state" id="state"&gt;</code></pre>
                    </div>
                    <p class="text-sm text-cyan-800 mt-2">
                        This single line of code triggers a complex 7-step process every time you type!
                    </p>
                </div>

                <div class="space-y-4 mb-6">
                    <div class="flex gap-4">
                        <div
                            class="flex-shrink-0 w-10 h-10 bg-cyan-500 text-white rounded-full flex items-center justify-center font-bold">
                            1</div>
                        <div class="flex-1 bg-cyan-50 rounded-lg p-4 border border-cyan-200">
                            <h5 class="font-bold text-cyan-900 mb-2">User Types "H"</h5>
                            <p class="text-sm text-cyan-800">You type the letter "H" in the input field</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div
                            class="flex-shrink-0 w-10 h-10 bg-purple-500 text-white rounded-full flex items-center justify-center font-bold">
                            2</div>
                        <div class="flex-1 bg-purple-50 rounded-lg p-4 border border-purple-200">
                            <h5 class="font-bold text-purple-900 mb-2">Proxy Intercepts (JavaScript)</h5>
                            <p class="text-sm text-purple-800 mb-2">Livewire's JavaScript Proxy detects the property
                                change</p>
                            <pre class="text-xs bg-white p-2 rounded border border-purple-300 text-purple-900"><code>proxy.state = "H" // Triggers set() trap</code></pre>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div
                            class="flex-shrink-0 w-10 h-10 bg-indigo-500 text-white rounded-full flex items-center justify-center font-bold">
                            3</div>
                        <div class="flex-1 bg-indigo-50 rounded-lg p-4 border border-indigo-200">
                            <h5 class="font-bold text-indigo-900 mb-2">Creates Snapshot & Sends AJAX</h5>
                            <p class="text-sm text-indigo-800 mb-2">JavaScript creates a snapshot of component state
                                and sends it to the server</p>
                            <pre class="text-xs bg-white p-2 rounded border border-indigo-300 text-indigo-900"><code>POST /livewire/update
{ "state": "H", "memo": {...} }</code></pre>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div
                            class="flex-shrink-0 w-10 h-10 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold">
                            4</div>
                        <div class="flex-1 bg-blue-50 rounded-lg p-4 border border-blue-200">
                            <h5 class="font-bold text-blue-900 mb-2">PHP Component Receives Update</h5>
                            <p class="text-sm text-blue-800 mb-2">Server updates the property automatically</p>
                            <pre class="text-xs bg-white p-2 rounded border border-blue-300 text-blue-900"><code>$this->state = "H"; // Updated!</code></pre>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div
                            class="flex-shrink-0 w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center font-bold">
                            5</div>
                        <div class="flex-1 bg-green-50 rounded-lg p-4 border border-green-200">
                            <h5 class="font-bold text-green-900 mb-2">Calls updatedState() Hook</h5>
                            <p class="text-sm text-green-800 mb-2">Your custom logic runs - this is where the Observer
                                Pattern kicks in!</p>
                            <pre class="text-xs bg-white p-2 rounded border border-green-300 text-green-900"><code>public function updatedState($value) {
    $this->dispatch('stateUpdated', $value);
}</code></pre>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div
                            class="flex-shrink-0 w-10 h-10 bg-yellow-500 text-white rounded-full flex items-center justify-center font-bold">
                            6</div>
                        <div class="flex-1 bg-yellow-50 rounded-lg p-4 border border-yellow-200">
                            <h5 class="font-bold text-yellow-900 mb-2">Server Responds with Effects</h5>
                            <p class="text-sm text-yellow-800 mb-2">Server sends back the dispatched event</p>
                            <pre class="text-xs bg-white p-2 rounded border border-yellow-300 text-yellow-900"><code>{ "dispatches": [
    { "event": "stateUpdated", "params": ["H"] }
] }</code></pre>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div
                            class="flex-shrink-0 w-10 h-10 bg-orange-500 text-white rounded-full flex items-center justify-center font-bold">
                            7</div>
                        <div class="flex-1 bg-orange-50 rounded-lg p-4 border border-orange-200">
                            <h5 class="font-bold text-orange-900 mb-2">JavaScript Dispatches Event</h5>
                            <p class="text-sm text-orange-800 mb-2">All Observer components listening with <code
                                    class="bg-white px-1 rounded">#[On('stateUpdated')]</code> receive the event and
                                update!</p>
                            <pre class="text-xs bg-white p-2 rounded border border-orange-300 text-orange-900"><code>// All 3 Observers update simultaneously! 🎉</code></pre>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white rounded-lg p-6">
                    <h4 class="font-bold text-lg mb-3 flex items-center gap-2">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"
                                clip-rule="evenodd" />
                        </svg>
                        The Magic of wire:model.live
                    </h4>
                    <div class="grid md:grid-cols-2 gap-4 text-sm">
                        <div class="bg-white/10 rounded-lg p-3">
                            <p class="font-semibold mb-1">✅ No JavaScript Required</p>
                            <p class="text-cyan-100">You write zero JavaScript code</p>
                        </div>
                        <div class="bg-white/10 rounded-lg p-3">
                            <p class="font-semibold mb-1">✅ Real-time Updates</p>
                            <p class="text-cyan-100">Updates on every keystroke (.live)</p>
                        </div>
                        <div class="bg-white/10 rounded-lg p-3">
                            <p class="font-semibold mb-1">✅ Automatic AJAX</p>
                            <p class="text-cyan-100">Handles all server communication</p>
                        </div>
                        <div class="bg-white/10 rounded-lg p-3">
                            <p class="font-semibold mb-1">✅ Observer Pattern</p>
                            <p class="text-cyan-100">Triggers events to all listeners</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 bg-cyan-100 border-l-4 border-cyan-500 p-4 rounded-r-lg">
                    <p class="text-sm text-cyan-900">
                        <strong>Modifiers:</strong> You can use <code class="bg-white px-1 rounded">.blur</code>
                        (update on blur),
                        <code class="bg-white px-1 rounded">.debounce.500ms</code> (wait 500ms after typing), or
                        <code class="bg-white px-1 rounded">.throttle.1s</code> (max once per second) instead of <code
                            class="bg-white px-1 rounded">.live</code>
                    </p>
                </div>
            </div>

            <!-- Visual Comparison -->
            <div class="bg-gradient-to-br from-indigo-900 to-purple-900 rounded-xl shadow-lg p-8 text-white">
                <h3 class="text-2xl font-bold mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                    Visual Comparison: Two Perspectives
                </h3>

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-indigo-800 rounded-lg p-6 border border-indigo-600">
                        <h4 class="font-bold text-yellow-300 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd" />
                            </svg>
                            Mary's Deep Dive (Framework Internals)
                        </h4>
                        <div class="bg-indigo-900 rounded p-4 font-mono text-xs text-indigo-100 space-y-1">
                            <div class="border border-indigo-600 p-3 rounded">
                                <div class="text-yellow-300 font-bold mb-2">Livewire's Internal Architecture</div>
                                <div class="space-y-1">
                                    <div>1. Proxy intercepts property change</div>
                                    <div>2. Creates snapshot of state</div>
                                    <div>3. Sends AJAX request</div>
                                    <div>4. PHP processes</div>
                                    <div>5. Returns new HTML</div>
                                    <div>6. JavaScript updates DOM</div>
                                    <div>7. Cleanup old listeners</div>
                                </div>
                            </div>
                        </div>
                        <p class="text-indigo-200 text-sm mt-3">
                            Focus: <strong>How Livewire works internally</strong>
                        </p>
                    </div>

                    <div class="bg-purple-800 rounded-lg p-6 border border-purple-600">
                        <h4 class="font-bold text-green-300 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                            </svg>
                            Our PoC (Application Level)
                        </h4>
                        <div class="bg-purple-900 rounded p-4 font-mono text-xs text-purple-100 space-y-1">
                            <div class="border border-purple-600 p-3 rounded">
                                <div class="text-green-300 font-bold mb-2">Application-Level Pattern</div>
                                <div class="space-y-1">
                                    <div>Subject → dispatch()</div>
                                    <div class="ml-4">↓</div>
                                    <div>Observers → #[On()] listen</div>
                                    <div class="ml-4">↓</div>
                                    <div>Update UI automatically</div>
                                </div>
                            </div>
                        </div>
                        <p class="text-purple-200 text-sm mt-3">
                            Focus: <strong>How developers use Livewire</strong>
                        </p>
                    </div>
                </div>

                <div class="mt-6 bg-yellow-500 text-yellow-900 rounded-lg p-4">
                    <p class="text-sm font-semibold">
                        💡 Both perspectives are valuable! Mary's talk explains the <strong>engine</strong>, while our
                        PoC teaches you to <strong>drive</strong>.
                    </p>
                </div>
            </div>
        </div>

        <!-- Real-World Use Cases -->
        <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-xl shadow-lg p-8 text-white">
            <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                    </path>
                </svg>
                Real-World Use Cases
            </h2>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-gray-800 rounded-lg p-5 border border-gray-700">
                    <h4 class="font-semibold text-blue-400 mb-2">🔔 Notification Systems</h4>
                    <p class="text-gray-300 text-sm">
                        When a user action occurs (e.g., new message), multiple UI components (notification bell,
                        sidebar, toast) update automatically.
                    </p>
                </div>
                <div class="bg-gray-800 rounded-lg p-5 border border-gray-700">
                    <h4 class="font-semibold text-green-400 mb-2">📊 Dashboard Widgets</h4>
                    <p class="text-gray-300 text-sm">
                        Filter changes in one widget propagate to charts, tables, and stats across the dashboard without
                        tight coupling.
                    </p>
                </div>
                <div class="bg-gray-800 rounded-lg p-5 border border-gray-700">
                    <h4 class="font-semibold text-purple-400 mb-2">🛒 Shopping Cart</h4>
                    <p class="text-gray-300 text-sm">
                        Adding items to cart updates the cart icon, sidebar preview, and checkout button simultaneously.
                    </p>
                </div>
                <div class="bg-gray-800 rounded-lg p-5 border border-gray-700">
                    <h4 class="font-semibold text-yellow-400 mb-2">👥 User Presence</h4>
                    <p class="text-gray-300 text-sm">
                        Online status changes broadcast to all components showing user lists, avatars, or activity
                        feeds.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
