<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

new #[Layout('layouts.app'), Title('LiveWire 4 Features PoC')] class extends Component {
    //
}; ?>

<div
    class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 dark:from-zinc-900 dark:via-zinc-900 dark:to-zinc-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="text-center mb-16">
            <h1 class="text-5xl font-bold text-zinc-900 dark:text-white mb-4">
                LiveWire 4 Features
            </h1>
            <p class="text-xl text-zinc-600 dark:text-zinc-400 mb-2">
                Comprehensive Proof of Concept
            </p>
            <p class="text-sm text-zinc-500 dark:text-zinc-500">
                Based on Caleb Porzio's LiveWire 4 Keynote
            </p>
        </div>

        <!-- Feature Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            <!-- Request Interceptors -->
            <a href="/interceptors" wire:navigate
                class="group bg-white dark:bg-zinc-800 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 p-6 border border-zinc-200 dark:border-zinc-700 hover:border-indigo-500 dark:hover:border-indigo-500">
                <div class="flex items-center gap-4 mb-4">
                    <div
                        class="p-3 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg group-hover:bg-indigo-500 transition-colors">
                        <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400 group-hover:text-white" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Request Interceptors</h3>
                </div>
                <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4">
                    Intercept and customize LiveWire requests with hooks for onSend, onResponse, onRedirect, and
                    onError.
                </p>
                <div
                    class="flex items-center text-sm font-medium text-indigo-600 dark:text-indigo-400 group-hover:text-indigo-700">
                    Explore →
                </div>
            </a>

            <!-- Smart Loading Indicators -->
            <a href="/loading" wire:navigate
                class="group bg-white dark:bg-zinc-800 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 p-6 border border-zinc-200 dark:border-zinc-700 hover:border-purple-500 dark:hover:border-purple-500">
                <div class="flex items-center gap-4 mb-4">
                    <div
                        class="p-3 bg-purple-100 dark:bg-purple-900/30 rounded-lg group-hover:bg-purple-500 transition-colors">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400 group-hover:text-white" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Loading Indicators</h3>
                </div>
                <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4">
                    Automatic data-loading attributes with cross-component awareness for seamless UX.
                </p>
                <div
                    class="flex items-center text-sm font-medium text-purple-600 dark:text-purple-400 group-hover:text-purple-700">
                    Explore →
                </div>
            </a>

            <!-- Blaze Optimization -->
            <a href="/blaze" wire:navigate
                class="group bg-white dark:bg-zinc-800 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 p-6 border border-zinc-200 dark:border-zinc-700 hover:border-orange-500 dark:hover:border-orange-500">
                <div class="flex items-center gap-4 mb-4">
                    <div
                        class="p-3 bg-orange-100 dark:bg-orange-900/30 rounded-lg group-hover:bg-orange-500 transition-colors">
                        <svg class="w-6 h-6 text-orange-600 dark:text-orange-400 group-hover:text-white" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Blaze Engine</h3>
                </div>
                <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4">
                    Code folding and compile-time optimization for blazing-fast Blade component rendering.
                </p>
                <div
                    class="flex items-center text-sm font-medium text-orange-600 dark:text-orange-400 group-hover:text-orange-700">
                    Explore →
                </div>
            </a>

            <!-- Basic Islands -->
            <a href="/islands" wire:navigate
                class="group bg-white dark:bg-zinc-800 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 p-6 border border-zinc-200 dark:border-zinc-700 hover:border-emerald-500 dark:hover:border-emerald-500">
                <div class="flex items-center gap-4 mb-4">
                    <div
                        class="p-3 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg group-hover:bg-emerald-500 transition-colors">
                        <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400 group-hover:text-white"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Basic Islands</h3>
                </div>
                <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4">
                    Isolate parts of your view with lazy, defer, and always modes for targeted updates.
                </p>
                <div
                    class="flex items-center text-sm font-medium text-emerald-600 dark:text-emerald-400 group-hover:text-emerald-700">
                    Explore →
                </div>
            </a>

            <!-- Advanced Islands -->
            <a href="/islands/advanced" wire:navigate
                class="group bg-white dark:bg-zinc-800 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 p-6 border border-zinc-200 dark:border-zinc-700 hover:border-cyan-500 dark:hover:border-cyan-500">
                <div class="flex items-center gap-4 mb-4">
                    <div
                        class="p-3 bg-cyan-100 dark:bg-cyan-900/30 rounded-lg group-hover:bg-cyan-500 transition-colors">
                        <svg class="w-6 h-6 text-cyan-600 dark:text-cyan-400 group-hover:text-white" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Advanced Islands</h3>
                </div>
                <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4">
                    Named islands, imperative rendering, streaming, and append/prepend modes.
                </p>
                <div
                    class="flex items-center text-sm font-medium text-cyan-600 dark:text-cyan-400 group-hover:text-cyan-700">
                    Explore →
                </div>
            </a>

            <!-- Nested Islands -->
            <a href="/islands/nested" wire:navigate
                class="group bg-white dark:bg-zinc-800 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 p-6 border border-zinc-200 dark:border-zinc-700 hover:border-pink-500 dark:hover:border-pink-500">
                <div class="flex items-center gap-4 mb-4">
                    <div
                        class="p-3 bg-pink-100 dark:bg-pink-900/30 rounded-lg group-hover:bg-pink-500 transition-colors">
                        <svg class="w-6 h-6 text-pink-600 dark:text-pink-400 group-hover:text-white" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 5a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 16a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-3zM14 16a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1h-4a1 1 0 01-1-1v-3z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Nested Islands</h3>
                </div>
                <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4">
                    Multi-level island nesting with independent updates and cascading modes.
                </p>
                <div
                    class="flex items-center text-sm font-medium text-pink-600 dark:text-pink-400 group-hover:text-pink-700">
                    Explore →
                </div>
            </a>

            <!-- Multi-Format Response Demo -->
            <a href="/multi-response-demo" wire:navigate
                class="group bg-white dark:bg-zinc-800 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 p-6 border border-zinc-200 dark:border-zinc-700 hover:border-rose-500 dark:hover:border-rose-500">
                <div class="flex items-center gap-4 mb-4">
                    <div
                        class="p-3 bg-rose-100 dark:bg-rose-900/30 rounded-lg group-hover:bg-rose-500 transition-colors">
                        <svg class="w-6 h-6 text-rose-600 dark:text-rose-400 group-hover:text-white" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Multi-Format Response</h3>
                </div>
                <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4">
                    One component, multiple formats. Return HTML, JSON, or PDF based on request headers. Full API
                    support with GET/POST.
                </p>
                <div
                    class="flex items-center text-sm font-medium text-rose-600 dark:text-rose-400 group-hover:text-rose-700">
                    Explore →
                </div>
            </a>

            <!-- Product CRUD Demo -->
            <a href="/products" wire:navigate
                class="col-span-1 lg:col-span-3 group bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 p-6 border border-indigo-200 dark:border-indigo-800 hover:border-indigo-500 dark:hover:border-indigo-500">
                <div class="flex items-center gap-4 mb-4">
                    <div
                        class="p-3 bg-indigo-100 dark:bg-indigo-900/40 rounded-lg group-hover:bg-indigo-600 transition-colors">
                        <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400 group-hover:text-white"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Full Product CRUD</h3>
                        <p class="text-xs text-indigo-600 dark:text-indigo-300 font-medium">All Features Combined</p>
                    </div>
                </div>
                <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-6 max-w-2xl">
                    See it all come together: Powergrid Table, Wire Sort, Nested Islands, Blaze Optimization, Smart
                    Loading, Global Interceptors, and Observer Pattern in one real-world module.
                </p>
                <div
                    class="flex items-center text-sm font-bold text-indigo-600 dark:text-indigo-400 group-hover:text-indigo-700">
                    Launch Demo Application →
                </div>
            </a>
        </div>

        <!-- Use Cases Section -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-zinc-900 dark:text-white mb-6">Real-World Use Cases</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Infinite Scroll -->
                <a href="/islands/infinite-scroll" wire:navigate
                    class="group bg-white dark:bg-zinc-800 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 p-6 border border-zinc-200 dark:border-zinc-700 hover:border-blue-500 dark:hover:border-blue-500">
                    <div class="flex items-center gap-3 mb-3">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                        <h3 class="text-base font-semibold text-zinc-900 dark:text-white">Infinite Scroll</h3>
                    </div>
                    <p class="text-sm text-zinc-600 dark:text-zinc-400">
                        Lazy loading with viewport detection and append mode.
                    </p>
                </a>

                <!-- Chat Interface -->
                <a href="/islands/chat" wire:navigate
                    class="group bg-white dark:bg-zinc-800 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 p-6 border border-zinc-200 dark:border-zinc-700 hover:border-green-500 dark:hover:border-green-500">
                    <div class="flex items-center gap-3 mb-3">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                            </path>
                        </svg>
                        <h3 class="text-base font-semibold text-zinc-900 dark:text-white">Chat Interface</h3>
                    </div>
                    <p class="text-sm text-zinc-600 dark:text-zinc-400">
                        Streaming messages with append mode and auto-scroll.
                    </p>
                </a>

                <!-- Load More -->
                <a href="/islands/load-more" wire:navigate
                    class="group bg-white dark:bg-zinc-800 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 p-6 border border-zinc-200 dark:border-zinc-700 hover:border-amber-500 dark:hover:border-amber-500">
                    <div class="flex items-center gap-3 mb-3">
                        <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <h3 class="text-base font-semibold text-zinc-900 dark:text-white">Load More</h3>
                    </div>
                    <p class="text-sm text-zinc-600 dark:text-zinc-400">
                        Pagination with named islands and append mode.
                    </p>
                </a>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="mt-12 p-6 bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700">
            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-3">About This PoC</h3>
            <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4">
                This Proof of Concept demonstrates all the major features announced in Caleb Porzio's LiveWire 4 keynote
                presentation.
                Each demo is interactive and includes code examples to help you understand how to implement these
                features in your own projects.
            </p>
            <div class="flex flex-wrap gap-2">
                <span
                    class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 text-xs font-medium rounded-full">LiveWire
                    4 Beta</span>
                <span
                    class="px-3 py-1 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 text-xs font-medium rounded-full">Blaze
                    0.1.0</span>
                <span
                    class="px-3 py-1 bg-pink-100 dark:bg-pink-900/30 text-pink-700 dark:text-pink-300 text-xs font-medium rounded-full">Flux
                    2.7</span>
                <span
                    class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 text-xs font-medium rounded-full">Laravel
                    12</span>
            </div>
        </div>
    </div>
</div>
