<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Message;
use App\Models\User;

new #[Layout('layouts.app'), Title('Chat Interface - LiveWire 4')] class extends Component {
    public string $newMessage = '';

    public function with(): array
    {
        return [
            'messages' => Message::with('user')->latest()->take(20)->get()->reverse(),
        ];
    }

    public function sendMessage()
    {
        if (trim($this->newMessage) === '') {
            return;
        }

        $user = User::first() ?? User::factory()->create();

        $message = Message::create([
            'user_id' => $user->id,
            'content' => $this->newMessage,
        ]);

        // Stream the new message to the island
        $this->streamIsland(
            'messages',
            mode: 'append',
            with: [
                'messages' => [$message->load('user')],
            ],
        );

        $this->newMessage = '';
    }
}; ?>

<div class="p-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-zinc-900 dark:text-white mb-2">Chat Interface</h1>
            <p class="text-zinc-600 dark:text-zinc-400">
                Streaming messages with append mode and auto-scroll using Islands.
            </p>
        </div>

        <!-- Chat Container -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden flex flex-col"
            style="height: 600px;">
            <!-- Chat Header -->
            <div
                class="p-4 border-b border-zinc-200 dark:border-zinc-700 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-semibold text-zinc-900 dark:text-white">LiveWire Chat</h2>
                        <p class="text-xs text-zinc-600 dark:text-zinc-400">Powered by Islands</p>
                    </div>
                </div>
            </div>

            <!-- Messages Area -->
            <div class="flex-1 overflow-y-auto p-4 space-y-3 chat-container" id="chat-messages">
                @island(name: 'messages')
                    @foreach ($messages as $message)
                        <div class="chat-message">
                            <div class="flex gap-3">
                                <div
                                    class="w-8 h-8 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-full flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                    {{ strtoupper(substr($message->user->name, 0, 1)) }}
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-baseline gap-2 mb-1">
                                        <span
                                            class="font-semibold text-sm text-zinc-900 dark:text-white">{{ $message->user->name }}</span>
                                        <span
                                            class="text-xs text-zinc-500 dark:text-zinc-400">{{ $message->created_at->format('H:i') }}</span>
                                    </div>
                                    <div class="bg-zinc-100 dark:bg-zinc-700 rounded-lg rounded-tl-none px-4 py-2">
                                        <p class="text-sm text-zinc-900 dark:text-white">{{ $message->content }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endisland
            </div>

            <!-- Input Area -->
            <div class="p-4 border-t border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-900">
                <form wire:submit="sendMessage" class="flex gap-3">
                    <flux:input type="text" name="newMessage" wire:model="newMessage" placeholder="Type a message..."
                        variant="outline" kbd="⌘K" size="lg" autofocus />
                    <flux:button type="submit"
                        class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition-colors">
                        Send
                    </flux:button>
                </form>
            </div>
        </div>

        <!-- Code Example -->
        <div class="mt-8 bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-4">Code Example</h2>

            <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs"><code>
@island(name: 'messages')
@foreach ($messages as $message)
<div>{{ $message->content }}</div>
@endforeach
@endisland

public function sendMessage()
{
    $message = Message::create([...]);
    
    // Stream new message with append mode
    $this->streamIsland('messages', mode: 'append', with: [
        'messages' => [$message]
    ]);
}</code></pre>
        </div>
    </div>
</div>

@assets
    <script>
        // Auto-scroll to bottom when new messages arrive
        const chatContainer = document.getElementById('chat-messages');
        if (chatContainer) {
            const observer = new MutationObserver(() => {
                chatContainer.scrollTop = chatContainer.scrollHeight;
            });

            observer.observe(chatContainer, {
                childList: true,
                subtree: true
            });
        }
    </script>
@endassets
